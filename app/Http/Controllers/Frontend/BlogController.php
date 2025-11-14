<?php

namespace App\Http\Controllers\Frontend;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index()
    {
        $news = News::latest()->where('status', 'published')->paginate(10);
        return view('frontend.blog.blog', compact('news'));
    }

    public function show($slug)
    {
        $news = News::where('slug', $slug)->where('status', 'published')->firstOrFail();
        if (!$news) {
            return view('frontend.404');
        }

        $newsAll = News::latest()->where('status', 'published')->where('id', '!=', $news->id)->take(5)->get();
        return view('frontend.blog.blog-detail', compact('news', 'newsAll'));
    }
}
