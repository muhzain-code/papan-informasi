<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $search  = $request->input('search');
        $entries = $request->input('entries', 10); // default 10 rows per page

        $pages = Page::query()
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('meta_title', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate($entries)
            ->appends([
                'search'  => $search,
                'entries' => $entries
            ]);

        return view('pages.index', compact('pages', 'search', 'entries'));
    }


    public function create()
    {
        return view('pages.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('pages', 'public');
        }

        Page::create($validated);

        return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil dibuat!');
    }

    public function show(Page $page)
    {
        $page->featured_image_url = $page->featured_image ? url(Storage::url($page->featured_image)) : null;
        return view('pages.show', compact('page'));
    }

    public function edit(Page $page)
    {
        $page->featured_image_url = $page->featured_image ? url(Storage::url($page->featured_image)) : null;
        return view('pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($page->featured_image && Storage::disk('public')->exists($page->featured_image)) {
                Storage::disk('public')->delete($page->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('pages', 'public');
        }

        $page->update($validated);

        return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil diperbarui!');
    }

    public function destroy(Page $page)
    {
        if ($page->featured_image && Storage::disk('public')->exists($page->featured_image)) {
            Storage::disk('public')->delete($page->featured_image);
        }

        $page->delete();

        return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil dihapus!');
    }

    public function showPublic(Page $page)
    {
        $page->featured_image_url = $page->featured_image ? url(Storage::url($page->featured_image)) : null;
        return view('frontend.pages.show', compact('page'));
    }
}
