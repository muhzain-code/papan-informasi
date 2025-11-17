<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\News;
use App\Models\Room;
use App\Models\Event;
use App\Models\Video;
use App\Models\Course;
use App\Models\Contact;
use App\Models\Lecturer;
use App\Models\Schedule;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $newsCount      = News::count();
        $infoCount      = Info::count();
        $videoCount     = Video::count();

        $courseCount    = Course::count();
        $roomCount      = Room::count();
        $lecturerCount  = Lecturer::count();

        $recentActivity = \Spatie\Activitylog\Models\Activity::with('causer')
            ->latest()
            ->limit(10)
            ->get();

        return view('Home.index', compact(
            'user',
            'newsCount',
            'infoCount',
            'videoCount',
            'courseCount',
            'roomCount',
            'lecturerCount',
            'recentActivity'
        ));
    }
}
