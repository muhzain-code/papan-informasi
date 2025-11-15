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
        // Ambil user saat ini
        $user = Auth::user();

        // Count data utama
        $newsCount    = News::count();
        $agendaCount  = Event::count();
        $contactCount = Contact::count();

        // Recent activity dummy (karena user belum punya tabel activity)
        $recentActivity = collect([
            (object)[
                'activity' => 'Menambahkan berita baru',
                'created_at' => now()->subMinutes(5)
            ],
            (object)[
                'activity' => 'Mengedit agenda kegiatan',
                'created_at' => now()->subHour()
            ],
            (object)[
                'activity' => 'Pesan baru masuk dari pengunjung',
                'created_at' => now()->subHours(2)
            ],
        ]);

        return view('Home.index', compact(
            'user',
            'newsCount',
            'agendaCount',
            'contactCount',
            'recentActivity'
        ));
    }
}
