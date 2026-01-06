<?php

namespace App\Services;

use App\Models\JdwFakultas;
use App\Models\JdwProdi;
use App\Models\JdwMataKuliah;
use App\Models\JdwJadwal;
use App\Models\ApiSyncLog;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class UnujaApiService
{
    protected string $baseUrl;
    protected string $username;
    protected string $password;
    protected int $cacheMinutes = 170; // Token expires, refresh before 3 hours

    public function __construct()
    {
        $this->baseUrl = config('services.unuja.url', 'https://v3-api.unuja.ac.id');
        $this->username = config('services.unuja.username');
        $this->password = config('services.unuja.password');
    }

    /**
     * Login to UNUJA API and get token using Basic Auth
     */
    public function login(): ?string
    {
        try {
            $response = Http::withoutVerifying()
                ->timeout(30)
                ->withBasicAuth($this->username, $this->password)
                ->post("{$this->baseUrl}/login");

            if ($response->successful()) {
                $data = $response->json();
                $token = data_get($data, 'data.token');

                if ($token) {
                    Cache::put('unuja_api_token', $token, now()->addMinutes($this->cacheMinutes));
                    Log::info('UNUJA API: Login successful');
                    return $token;
                }
            }

            Log::error('UNUJA API: Login failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('UNUJA API: Login exception', ['error' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Get token from cache or login
     */
    public function getToken(): ?string
    {
        $token = Cache::get('unuja_api_token');

        if (!$token) {
            $token = $this->login();
        }

        return $token;
    }

    /**
     * Fetch Jadwal Kuliah data from API
     */
    public function getJadwalData(int $start = 0, int $limit = 50, string $smtId = '20251'): array
    {
        $token = $this->getToken();

        if (!$token) {
            Log::error('UNUJA API: Cannot get Jadwal data - no token');
            return [];
        }

        try {
            $response = Http::withoutVerifying()
                ->timeout(60)
                ->withHeaders([
                    'unuja-simpt-token' => $token,
                ])
                ->get("{$this->baseUrl}/bak/jdw/daftar", [
                    'i' => $start,
                    'j' => $limit,
                    'smt_id' => $smtId,
                ]);

            if ($response->successful()) {
                $data = $response->json();
                return data_get($data, 'data', []);
            }

            // Token might be expired, try to refresh
            if ($response->status() === 401) {
                Log::warning('UNUJA API: Token expired, refreshing...');
                Cache::forget('unuja_api_token');
                return $this->getJadwalData($start, $limit, $smtId);
            }

            Log::error('UNUJA API: Failed to get Jadwal data', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return [];
        } catch (\Exception $e) {
            Log::error('UNUJA API: Jadwal data exception', ['error' => $e->getMessage()]);
            return [];
        }
    }

    /**
     * Fetch all Jadwal data with pagination
     */
    public function getAllJadwalData(string $smtId = '20251'): array
    {
        $allData = [];
        $start = 0;
        $limit = 100;
        $maxIterations = 10; // Safety limit (1000 records max)

        for ($i = 0; $i < $maxIterations; $i++) {
            $data = $this->getJadwalData($start, $limit, $smtId);

            if (empty($data)) {
                break;
            }

            $allData = array_merge($allData, $data);
            
            if (count($data) < $limit) {
                break; // Last page
            }

            $start += $limit;
        }

        return $allData;
    }

    /**
     * Sync Jadwal data to normalized database tables
     */
    public function syncToDatabase(string $smtId = '20251'): array
    {
        $result = [
            'success' => false,
            'records_synced' => 0,
            'fakultas_synced' => 0,
            'prodi_synced' => 0,
            'mata_kuliah_synced' => 0,
            'error' => null,
        ];

        try {
            $data = $this->getAllJadwalData($smtId);

            if (empty($data)) {
                $result['error'] = 'No data received from API';
                $this->logSync('jadwal', 0, 'failed', $result['error']);
                return $result;
            }

            $now = now();

            DB::beginTransaction();

            // 1. Collect and upsert unique fakultas
            $fakultasMap = [];
            foreach ($data as $item) {
                $fakId = $item['fak_id'] ?? '';
                if ($fakId && !isset($fakultasMap[$fakId])) {
                    $fakultasMap[$fakId] = [
                        'api_id' => $fakId,
                        'nama' => $item['fak_nama'] ?? 'Unknown',
                        'singkatan' => $item['fak_singkatan'] ?? null,
                    ];
                }
            }
            foreach ($fakultasMap as $fak) {
                JdwFakultas::updateOrCreate(
                    ['api_id' => $fak['api_id']],
                    ['nama' => $fak['nama'], 'singkatan' => $fak['singkatan']]
                );
            }
            $result['fakultas_synced'] = count($fakultasMap);

            // 2. Collect and upsert unique prodi
            $prodiMap = [];
            foreach ($data as $item) {
                $prodiId = $item['prodi_id'] ?? '';
                if ($prodiId && !isset($prodiMap[$prodiId])) {
                    $prodiMap[$prodiId] = [
                        'api_id' => $prodiId,
                        'nama' => $item['prodi_nama'] ?? 'Unknown',
                        'singkatan' => $item['prodi_singkatan'] ?? null,
                        'jenjang' => $item['prodi_jenjang'] ?? null,
                        'fakultas_id' => $item['fak_id'] ?? '',
                    ];
                }
            }
            foreach ($prodiMap as $prodi) {
                JdwProdi::updateOrCreate(
                    ['api_id' => $prodi['api_id']],
                    [
                        'nama' => $prodi['nama'],
                        'singkatan' => $prodi['singkatan'],
                        'jenjang' => $prodi['jenjang'],
                        'fakultas_id' => $prodi['fakultas_id'],
                    ]
                );
            }
            $result['prodi_synced'] = count($prodiMap);

            // 3. Collect and upsert unique mata kuliah
            $mataKuliahMap = [];
            foreach ($data as $item) {
                $mkKode = $item['mata_kuliah_kode'] ?? '';
                if ($mkKode && !isset($mataKuliahMap[$mkKode])) {
                    $mataKuliahMap[$mkKode] = [
                        'kode' => $mkKode,
                        'nama' => $item['mata_kuliah_nama'] ?? 'Unknown',
                        'sks' => $item['mata_kuliah_sks'] ?? 0,
                    ];
                }
            }
            foreach ($mataKuliahMap as $mk) {
                JdwMataKuliah::updateOrCreate(
                    ['kode' => $mk['kode']],
                    ['nama' => $mk['nama'], 'sks' => $mk['sks']]
                );
            }
            $result['mata_kuliah_synced'] = count($mataKuliahMap);

            // 4. Clear old jadwal for this semester and insert fresh
            JdwJadwal::where('smt_id', $smtId)->delete();

            $synced = 0;
            foreach ($data as $item) {
                JdwJadwal::create([
                    'mata_kuliah_kode' => $item['mata_kuliah_kode'] ?? '',
                    'prodi_id' => $item['prodi_id'] ?? '',
                    'kelas_nama' => $item['kelas_nama'] ?? '',
                    'kelas_status' => $item['kelas_status'] ?? 'y',
                    'dosen' => $item['dosen'],
                    'hari' => $item['hari'] ?? '',
                    'jam' => $item['jam'] ?? '',
                    'ruangan' => $item['ruangan'],
                    'smt_id' => $smtId,
                    'gabung_kelas_nama' => $item['gabung_kelas_nama'],
                    'gabung_mata_kuliah_kode' => $item['gabung_mata_kuliah_kode'],
                    'gabung_mata_kuliah_nama' => $item['gabung_mata_kuliah_nama'],
                    'gabung_mata_kuliah_sks' => $item['gabung_mata_kuliah_sks'],
                    'synced_at' => $now,
                ]);
                $synced++;
            }

            DB::commit();

            $this->logSync('jadwal', $synced, 'success');

            $result['success'] = true;
            $result['records_synced'] = $synced;

            Log::info("UNUJA API: Synced {$synced} jadwal, {$result['fakultas_synced']} fakultas, {$result['prodi_synced']} prodi, {$result['mata_kuliah_synced']} mata kuliah");

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            $result['error'] = $e->getMessage();
            $this->logSync('jadwal', 0, 'failed', $e->getMessage());
            Log::error('UNUJA API: Sync exception', ['error' => $e->getMessage()]);
            return $result;
        }
    }

    /**
     * Log sync activity
     */
    protected function logSync(string $type, int $records, string $status, ?string $error = null): void
    {
        ApiSyncLog::create([
            'type' => $type,
            'records_synced' => $records,
            'status' => $status,
            'error_message' => $error,
            'synced_at' => now(),
        ]);
    }
}
