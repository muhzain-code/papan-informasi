<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SyncJadwalDataJob;
use App\Models\JdwJadwal;
use App\Models\JdwFakultas;
use App\Models\JdwProdi;
use App\Models\JdwMataKuliah;
use App\Models\ApiSyncLog;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $entries = $request->input('entries', 15);
        $hari = $request->input('hari');
        $fakultas = $request->input('fakultas');
        $prodi = $request->input('prodi');
        $semester = $request->input('semester');
        $dosen = $request->input('dosen');

        $jadwal = JdwJadwal::with(['mataKuliah', 'prodi.fakultas'])
            ->when($search, fn($q) => $q->whereHas('mataKuliah', fn($mq) => 
                    $mq->where('nama', 'like', "%{$search}%")
                        ->orWhere('kode', 'like', "%{$search}%"))
                ->orWhere('ruangan', 'like', "%{$search}%"))
            ->when($hari, fn($q) => $q->byHari($hari))
            ->when($fakultas, fn($q) => $q->byFakultas($fakultas))
            ->when($prodi, fn($q) => $q->byProdi($prodi))
            ->when($semester, fn($q) => $q->bySemester($semester))
            ->when($dosen, fn($q) => $q->byDosen($dosen))
            // Baris orderByRaw dan orderBy('jam') sudah dihapus
            ->paginate($entries)
            ->appends(compact('search', 'entries', 'hari', 'fakultas', 'prodi', 'semester', 'dosen'));

        $lastSync = ApiSyncLog::getLastSync('jadwal');

        // Filter data
        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $fakultasList = JdwFakultas::orderBy('nama')->get();
        $prodiList = JdwProdi::orderBy('nama')->get();
        $semesterList = JdwJadwal::distinct()->pluck('smt_id')->filter()->sort()->values();

        // Stats
        $stats = [
            'total_jadwal' => JdwJadwal::count(),
            'total_fakultas' => JdwFakultas::count(),
            'total_prodi' => JdwProdi::count(),
            'total_mata_kuliah' => JdwMataKuliah::count(),
        ];

        return view('jadwal.index', compact(
            'jadwal',
            'search',
            'entries',
            'lastSync',
            'hariList',
            'fakultasList',
            'prodiList',
            'semesterList',
            'hari',
            'fakultas',
            'prodi',
            'semester',
            'dosen',
            'stats'
        ));
    }
    // public function index(Request $request)
    // {
    //     $search = $request->input('search');
    //     $entries = $request->input('entries', 15);
    //     $hari = $request->input('hari');
    //     $fakultas = $request->input('fakultas');
    //     $prodi = $request->input('prodi');
    //     $semester = $request->input('semester');
    //     $dosen = $request->input('dosen');

    //     $jadwal = JdwJadwal::with(['mataKuliah', 'prodi.fakultas'])
    //         ->when($search, fn($q) => $q->whereHas('mataKuliah', fn($mq) => 
    //                 $mq->where('nama', 'like', "%{$search}%")
    //                     ->orWhere('kode', 'like', "%{$search}%"))
    //             ->orWhere('ruangan', 'like', "%{$search}%"))
    //         ->when($hari, fn($q) => $q->byHari($hari))
    //         ->when($fakultas, fn($q) => $q->byFakultas($fakultas))
    //         ->when($prodi, fn($q) => $q->byProdi($prodi))
    //         ->when($semester, fn($q) => $q->bySemester($semester))
    //         ->when($dosen, fn($q) => $q->byDosen($dosen))
    //         ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
    //         ->orderBy('jam')
    //         ->paginate($entries)
    //         ->appends(compact('search', 'entries', 'hari', 'fakultas', 'prodi', 'semester', 'dosen'));

    //     $lastSync = ApiSyncLog::getLastSync('jadwal');

    //     // Filter data
    //     $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
    //     $fakultasList = JdwFakultas::orderBy('nama')->get();
    //     $prodiList = JdwProdi::orderBy('nama')->get();
    //     $semesterList = JdwJadwal::distinct()->pluck('smt_id')->filter()->sort()->values();

    //     // Stats
    //     $stats = [
    //         'total_jadwal' => JdwJadwal::count(),
    //         'total_fakultas' => JdwFakultas::count(),
    //         'total_prodi' => JdwProdi::count(),
    //         'total_mata_kuliah' => JdwMataKuliah::count(),
    //     ];

    //     return view('jadwal.index', compact(
    //         'jadwal',
    //         'search',
    //         'entries',
    //         'lastSync',
    //         'hariList',
    //         'fakultasList',
    //         'prodiList',
    //         'semesterList',
    //         'hari',
    //         'fakultas',
    //         'prodi',
    //         'semester',
    //         'dosen',
    //         'stats'
    //     ));
    // }

    public function show($id)
    {
        $jadwal = JdwJadwal::with(['mataKuliah', 'prodi.fakultas'])->findOrFail($id);
        return view('jadwal.show', compact('jadwal'));
    }

    public function sync(Request $request)
    {
        $semester = $request->input('semester', '20251');

        SyncJadwalDataJob::dispatch($semester);

        return redirect()
            ->route('jadwal.index')
            ->with('success', 'Sync job telah dijalankan. Data akan diperbarui dalam beberapa saat.');
    }
}
