<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $search  = $request->input('search');
        $entries = $request->input('entries', 10);

        $news = News::query()
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->orderByRaw("published_at IS NULL ASC")
            ->orderBy('published_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate($entries)
            ->appends([
                'search'  => $search,
                'entries' => $entries
            ]);

        return view('news.index', compact('news', 'search', 'entries'));
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'content'  => 'required',
            'thumbnail' => 'nullable|image|max:2048',
            'status'   => 'required|in:draft,published',
        ]);

        $thumbnail = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail')->store('news', 'public');
        }

        News::create([
            'title'       => $request->title,
            'content'     => $request->content,
            'thumbnail'   => $thumbnail,
            'status'      => $request->status,
            'published_at' => $request->status === 'published' ? now() : null,
            'created_by'  => Auth::id(),
        ]);

        return redirect()->route('news.index')->with('success', 'Berita berhasil dibuat.');
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'content'      => 'required',
            'thumbnail'    => 'nullable|image|max:2048',
            'status'       => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        $thumbnail = $news->thumbnail;

        if ($request->hasFile('thumbnail')) {
            if ($thumbnail && Storage::disk('public')->exists($thumbnail)) {
                Storage::disk('public')->delete($thumbnail);
            }
            $thumbnail = $request->file('thumbnail')->store('news', 'public');
        }

        $publishedAt = $news->published_at; 

        if ($request->status === 'published') {
            if ($request->filled('published_at')) {
                $publishedAt = $request->published_at;  
            } elseif (! $news->published_at) {
                $publishedAt = now();  
            }
        } else {
            if ($request->filled('published_at')) {
                $publishedAt = $request->published_at;
            }
        }

        $news->update([
            'title'        => $request->title,
            'content'      => $request->content,
            'thumbnail'    => $thumbnail,
            'status'       => $request->status,
            'published_at' => $publishedAt,
            'updated_by'   => Auth::id(),
        ]);

        return redirect()->route('news.index')->with('success', 'Berita berhasil diperbarui.');
    }


    public function destroy(News $news)
    {
        $news->update(['deleted_by' => Auth::id()]);
        $news->delete();

        return redirect()->route('news.index')->with('success', 'Berita berhasil dihapus.');
    }

    public function publish(News $news)
    {
        $news->update([
            'status' => 'published',
            'published_at' => now(),
        ]);

        return redirect()->route('news.index')->with('success', 'Berita berhasil dipublikasikan.');
    }

    public function draft(News $news)
    {
        $news->update([
            'status' => 'draft',
            'published_at' => null,
        ]);

        return redirect()->route('news.index')->with('success', 'Berita berhasil diubah menjadi draft.');
    }
}
