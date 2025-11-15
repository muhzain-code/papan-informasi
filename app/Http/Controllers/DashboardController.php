<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Event;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // $user = Auth::user();

        // // Count data utama
        // $newsCount    = News::count();
        // $agendaCount  = Event::count();
        // $contactCount = Contact::count();

        // // Ambil aktivitas terbaru dari Spatie
        // $recentActivity = \Spatie\Activitylog\Models\Activity::with('causer')
        //     ->orderBy('created_at', 'desc')
        //     ->limit(10)
        //     ->get();

        // return view('Home.index', compact(
        //     'user',
        //     'newsCount',
        //     'agendaCount',
        //     'contactCount',
        //     'recentActivity'
        // ));
        return view('Home.index');
    }
}
