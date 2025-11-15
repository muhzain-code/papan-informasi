<?php

namespace App\Http\Controllers\Frontend;

use App\Models\News;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $news = News::where('status', 'published')
            ->orderBy('published_at', 'desc') 
            ->take(3)
            ->get();

        $events = Event::latest()->take(2)->get();

        return view('frontend.home.index', compact('news', 'events'));
    }
}
