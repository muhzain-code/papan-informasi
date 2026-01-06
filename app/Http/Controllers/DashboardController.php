<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\News;
use App\Models\Video;
use App\Models\JdwJadwal;
use App\Models\JdwFakultas;
use App\Models\JdwProdi;
use App\Models\JdwMataKuliah;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Content statistics
        $newsCount      = News::count();
        $infoCount      = Info::count();
        $videoCount     = Video::count();

        // Jadwal statistics from jdw_* tables
        $jadwalCount     = JdwJadwal::count();
        $fakultasCount   = JdwFakultas::count();
        $prodiCount      = JdwProdi::count();
        $mataKuliahCount = JdwMataKuliah::count();

        $recentActivity = \Spatie\Activitylog\Models\Activity::with('causer')
            ->latest()
            ->limit(10)
            ->get();

        return view('Home.index', compact(
            'user',
            'newsCount',
            'infoCount',
            'videoCount',
            'jadwalCount',
            'fakultasCount',
            'prodiCount',
            'mataKuliahCount',
            'recentActivity'
        ));
    }
}

