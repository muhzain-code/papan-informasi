<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $search  = $request->input('search');
        $entries = $request->input('entries', 10);

        $videos = Video::query()
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('video_url', 'like', "%{$search}%");
            })
            ->orderBy('order', 'asc')
            ->paginate($entries)
            ->appends([
                'search'  => $search,
                'entries' => $entries,
            ]);

        return view('videos.index', compact('videos', 'search', 'entries'));
    }

    public function create()
    {
        return view('videos.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'nullable|string|max:255',
            'source_type' => 'required|in:file,youtube',

            'video_path'  => 'required_if:source_type,file|file|mimes:mp4,mkv,avi,webm|max:204800',
            'video_url'   => 'required_if:source_type,youtube|nullable|string|max:500',

            'order'       => 'required|integer',
            'is_active'   => 'required|boolean',
        ]);

        $videoPath = null;

        if ($request->source_type === 'file' && $request->hasFile('video_path')) {
            $videoPath = $request->file('video_path')->store('videos', 'public');
        }

        Video::create([
            'title'       => $request->title,
            'source_type' => $request->source_type,
            'video_path'  => $videoPath,
            'video_url'   => $request->source_type === 'youtube' ? $request->video_url : null,
            'order'       => $request->order,
            'is_active'   => $request->is_active,
            'created_by'  => Auth::id(),
        ]);

        return redirect()->route('videos.index')->with('success', 'Video berhasil ditambahkan.');
    }


    public function show(Video $video)
    {
        return view('videos.show', compact('video'));
    }

    public function edit(Video $video)
    {
        return view('videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title'       => 'nullable|string|max:255',
            'source_type' => 'required|in:file,youtube',

            'video_path'  => 'nullable|file|mimes:mp4,mkv,avi,webm|max:204800',
            'video_url'   => 'nullable|required_if:source_type,youtube|string|max:500',

            'order'       => 'required|integer',
            'is_active'   => 'required|boolean',
        ]);

        $videoPath = $video->video_path;

        if ($video->source_type === 'file' && $request->source_type === 'youtube') {
            if ($videoPath && Storage::disk('public')->exists($videoPath)) {
                Storage::disk('public')->delete($videoPath);
            }

            $videoPath = null;
        }

        if ($request->source_type === 'file' && $request->hasFile('video_path')) {

            if ($videoPath && Storage::disk('public')->exists($videoPath)) {
                Storage::disk('public')->delete($videoPath);
            }

            $videoPath = $request->file('video_path')->store('videos', 'public');
        }

        $video->update([
            'title'       => $request->title,
            'source_type' => $request->source_type,
            'video_path'  => $request->source_type === 'file' ? $videoPath : null,
            'video_url'   => $request->source_type === 'youtube' ? $request->video_url : null,
            'order'       => $request->order,
            'is_active'   => $request->is_active,
            'updated_by'  => Auth::id(),
        ]);

        return redirect()->route('videos.index')->with('success', 'Video berhasil diperbarui.');
    }




    public function destroy(Video $video)
    {
        // hapus file jika ada
        if ($video->video_path && Storage::disk('public')->exists($video->video_path)) {
            Storage::disk('public')->delete($video->video_path);
        }

        $video->update(['deleted_by' => Auth::id()]);
        $video->delete();

        return redirect()->route('videos.index')->with('success', 'Video berhasil dihapus.');
    }
}
