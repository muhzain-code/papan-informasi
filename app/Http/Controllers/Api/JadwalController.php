<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SyncJadwalDataJob;
use App\Models\JdwJadwal;
use App\Models\JdwFakultas;
use App\Models\JdwProdi;
use App\Models\ApiSyncLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Get jadwal data for frontend display - filtered by today or specified day
     */
    public function index(Request $request): JsonResponse
    {
        $query = JdwJadwal::with(['mataKuliah', 'prodi.fakultas']);

        // Filter by hari (day)
        if ($request->has('hari')) {
            $query->byHari($request->hari);
        } else {
            // Default: show today's schedule
            $query->hariIni();
        }

        // Filter by fakultas
        if ($request->has('fak_id')) {
            $query->byFakultas($request->fak_id);
        }

        // Filter by prodi
        if ($request->has('prodi_id')) {
            $query->byProdi($request->prodi_id);
        }

        $limit = $request->input('limit', 50);
        
        $jadwal = $query
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->orderBy('jam')
            ->limit($limit)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'kelas' => $item->kelas_nama,
                    'kode' => $item->mata_kuliah_kode,
                    'mata_kuliah' => $item->mataKuliah?->nama ?? 'N/A',
                    'sks' => $item->mataKuliah?->sks ?? 0,
                    'dosen' => $item->dosen_nama,
                    'hari' => $item->hari,
                    'waktu' => $item->waktu,
                    'ruangan' => $item->ruangan ?? '-',
                    'prodi' => $item->prodi?->singkatan ?? $item->prodi?->nama ?? 'N/A',
                    'fakultas' => $item->prodi?->fakultas?->singkatan ?? 'N/A',
                ];
            });

        $lastSync = ApiSyncLog::getLastSync('jadwal');

        return response()->json([
            'success' => true,
            'data' => $jadwal,
            'synced_at' => $lastSync?->synced_at?->toIso8601String(),
            'total' => JdwJadwal::count(),
        ]);
    }

    /**
     * Get last sync timestamp
     */
    public function lastSync(): JsonResponse
    {
        $lastSync = ApiSyncLog::getLastSync('jadwal');

        return response()->json([
            'success' => true,
            'synced_at' => $lastSync?->synced_at?->toIso8601String(),
            'records_synced' => $lastSync?->records_synced,
        ]);
    }

    /**
     * Get statistics grouped by fakultas and hari
     */
    public function stats(): JsonResponse
    {
        $byFakultas = JdwFakultas::withCount('jadwal')
            ->orderBy('nama')
            ->get()
            ->map(fn($f) => [
                'singkatan' => $f->singkatan,
                'nama' => $f->nama,
                'total' => $f->jadwal_count,
            ]);

        $byHari = JdwJadwal::selectRaw('hari, COUNT(*) as total')
            ->groupBy('hari')
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->get();

        $byProdi = JdwProdi::withCount('jadwal')
            ->orderBy('nama')
            ->get()
            ->map(fn($p) => [
                'singkatan' => $p->singkatan,
                'nama' => $p->nama,
                'jenjang' => $p->jenjang,
                'total' => $p->jadwal_count,
            ]);

        return response()->json([
            'success' => true,
            'by_fakultas' => $byFakultas,
            'by_hari' => $byHari,
            'by_prodi' => $byProdi,
            'total' => JdwJadwal::count(),
        ]);
    }

    /**
     * Get dropdown data for filters
     */
    public function filters(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'fakultas' => JdwFakultas::orderBy('nama')->get(['api_id', 'nama', 'singkatan']),
            'prodi' => JdwProdi::orderBy('nama')->get(['api_id', 'nama', 'singkatan', 'jenjang', 'fakultas_id']),
            'hari' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
        ]);
    }

    /**
     * Trigger manual sync (admin only)
     */
    public function sync(Request $request): JsonResponse
    {
        $semester = $request->input('semester', '20251');

        SyncJadwalDataJob::dispatch($semester);

        return response()->json([
            'success' => true,
            'message' => 'Sync job dispatched successfully',
        ]);
    }
}
