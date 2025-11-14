<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgendaController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(8);
        return view('frontend.event.event', compact('events'));
    }

    public function show($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        if (!$event) {
            return view('frontend.404');
        }
        return view('frontend.event.event-detail', compact('event'));
    }
}
