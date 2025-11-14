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
        $news = News::latest()->take(3)->where('status', 'published')->get();

        $events = Event::latest()->take(5)->get();

        return view('frontend.home.index', compact('news', 'events'));
    }
}
