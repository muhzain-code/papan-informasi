<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        $data = Video::orderBy('order')->paginate(10);
        return view('videos.index', compact('data'));
    }

    public function create()
    {
        return view('videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'nullable|string|max:255',
            'source_type' => 'required|in:file,youtube,url',
            'video_file'  => 'required_if:source_type,file|mimetypes:video/mp4,video/x-msvideo,video/x-matroska|max:51200',
            'video_url'   => 'nullable|string|max:255',
            'order'       => 'required|integer',
        ]);

        $videoPath = null;

        if ($request->source_type === 'file' && $request->hasFile('video_file')) {
            $videoPath = $request->file('video_file')->store('videos', 'public');
        }

        Video::create([
            'title'       => $request->title,
            'source_type' => $request->source_type,
            'video_path'  => $videoPath,
            'video_url'   => $request->video_url,
            'order'       => $request->order,
            'is_active'   => true,
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
            'source_type' => 'required|in:file,youtube,url',
            'video_file'  => 'nullable|mimetypes:video/mp4,video/x-msvideo,video/x-matroska|max:51200',
            'video_url'   => 'nullable|string|max:255',
            'order'       => 'required|integer',
        ]);

        $videoPath = $video->video_path;

        if ($request->source_type === 'file' && $request->hasFile('video_file')) {
            if ($videoPath && Storage::disk('public')->exists($videoPath)) {
                Storage::disk('public')->delete($videoPath);
            }

            $videoPath = $request->file('video_file')->store('videos', 'public');
        }

        $video->update([
            'title'       => $request->title,
            'source_type' => $request->source_type,
            'video_path'  => $videoPath,
            'video_url'   => $request->video_url,
            'order'       => $request->order,
            'updated_by'  => Auth::id(),
        ]);

        return redirect()->route('videos.index')->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy(Video $video)
    {
        if ($video->video_path && Storage::disk('public')->exists($video->video_path)) {
            Storage::disk('public')->delete($video->video_path);
        }

        $video->update(['deleted_by' => Auth::id()]);
        $video->delete();

        return redirect()->route('videos.index')->with('success', 'Video berhasil dihapus.');
    }
}
