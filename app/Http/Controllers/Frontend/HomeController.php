<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Info;
use App\Models\News;
use App\Models\Video;
use App\Models\Announcement;
use App\Models\Notification;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $news = News::where('status', 'published')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->limit(5)
            ->get(['id', 'title', 'content', 'thumbnail', 'published_at']);

        $infos = Info::where('status', 'active')
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get(['id', 'title', 'message', 'date']);

        $videos = Video::where('is_active', true)
            ->orderBy('order', 'asc')
            ->get(['id', 'source_type', 'video_path', 'video_url', 'title']);

        $announcements = Announcement::where('status', 'published')
            ->latest()
            ->limit(5)
            ->get(['title']);

        // Get notifications for today
        $todayDate = now('Asia/Jakarta')->toDateString();
        $notifications = Notification::with('creator:id,name')
            ->whereDate('date', $todayDate)
            ->orderBy('date', 'desc')
            ->get(['id', 'message', 'date', 'created_by']);

        return view('frontend.index', [
            'news' => $news,
            'infos' => $infos,
            'videos' => $videos,
            'announcements' => $announcements,
            'notifications' => $notifications,
        ]);
    }
}
