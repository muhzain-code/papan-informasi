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
        $search     = $request->input('search');
        $entries    = $request->input('entries', 10);
        $sourceType = $request->input('source_type');
        $isActive   = $request->input('is_active');

        $videos = Video::query()
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('video_url', 'like', "%{$search}%");
            })
            ->when($sourceType, function ($query) use ($sourceType) {
                $query->where('source_type', $sourceType);
            })
            ->when($isActive !== null && $isActive !== '', function ($query) use ($isActive) {
                $query->where('is_active', $isActive);
            })
            ->orderBy('order', 'asc')
            ->paginate($entries)
            ->appends([
                'search'      => $search,
                'entries'     => $entries,
                'source_type' => $sourceType,
                'is_active'   => $isActive,
            ]);

        return view('videos.index', compact('videos', 'search', 'entries', 'sourceType', 'isActive'));
    }

    public function create()
    {
        return view('videos.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'title'       => 'nullable|string|max:255',
            'source_type' => 'required|in:file,youtube',
            'video_path'  => 'required_if:source_type,file|file|mimes:mp4,mkv,avi,webm|max:204800',
            'video_url'   => 'required_if:source_type,youtube|nullable|string|max:500',
            'order'       => 'required|integer',
            'is_active'   => 'required|boolean',
            'is_default'  => 'nullable|boolean',
        ];

        $messages = [
            'title.max'                  => 'Judul video maksimal 255 karakter.',
            'source_type.required'       => 'Jenis sumber video wajib dipilih.',
            'source_type.in'             => 'Jenis sumber video harus berupa file atau youtube.',
            'video_path.required_if'     => 'File video wajib diunggah jika sumber berupa file.',
            'video_path.file'            => 'Video harus berupa file yang valid.',
            'video_path.mimes'           => 'Format video harus: mp4, mkv, avi, atau webm.',
            'video_path.max'             => 'Ukuran file video maksimal 200MB.',
            'video_url.required_if'      => 'URL YouTube wajib diisi jika sumber berupa YouTube.',
            'video_url.max'              => 'URL YouTube maksimal 500 karakter.',
            'order.required'             => 'Urutan tampil wajib diisi.',
            'order.integer'              => 'Urutan tampil harus berupa angka.',
            'is_active.required'         => 'Status wajib dipilih.',
            'is_active.boolean'          => 'Status harus berupa aktif atau tidak aktif.',
        ];

        // Jika bukan default, wajib isi start_date dan end_date
        if (!$request->boolean('is_default')) {
            $rules['start_date'] = 'required|date';
            $rules['end_date']   = 'required|date|after_or_equal:start_date';
            $messages['start_date.required']       = 'Tanggal mulai wajib diisi jika bukan video default.';
            $messages['start_date.date']           = 'Tanggal mulai harus berupa tanggal yang valid.';
            $messages['end_date.required']         = 'Tanggal selesai wajib diisi jika bukan video default.';
            $messages['end_date.date']             = 'Tanggal selesai harus berupa tanggal yang valid.';
            $messages['end_date.after_or_equal']   = 'Tanggal selesai harus sama atau setelah tanggal mulai.';
        }

        $request->validate($rules, $messages);

        // Jika YouTube → cek link dan convert
        $youtubeUrl = null;
        if ($request->source_type === 'youtube') {
            $converted = $this->convertToYoutubeEmbed($request->video_url);

            if (!$converted) {
                return back()->withErrors(['video_url' => 'Link YouTube tidak valid. Gunakan format seperti: https://www.youtube.com/watch?v=xxxx'])->withInput();
            }

            $youtubeUrl = $converted;
        }

        // Jika File
        $videoPath = null;
        if ($request->source_type === 'file' && $request->hasFile('video_path')) {
            $videoPath = $request->file('video_path')->store('videos', 'public');
        }

        $isDefault = $request->boolean('is_default');

        Video::create([
            'title'       => $request->title,
            'source_type' => $request->source_type,
            'video_path'  => $videoPath,
            'video_url'   => $youtubeUrl,
            'order'       => $request->order,
            'is_active'   => $request->is_active,
            'is_default'  => $isDefault,
            'start_date'  => $isDefault ? null : $request->start_date,
            'end_date'    => $isDefault ? null : $request->end_date,
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
        $rules = [
            'title'       => 'nullable|string|max:255',
            'source_type' => 'required|in:file,youtube',
            'video_path'  => 'nullable|file|mimes:mp4,mkv,avi,webm|max:204800',
            'video_url'   => 'nullable|required_if:source_type,youtube|string|max:500',
            'order'       => 'required|integer',
            'is_active'   => 'required|boolean',
            'is_default'  => 'nullable|boolean',
        ];

        $messages = [
            'title.max'                  => 'Judul video maksimal 255 karakter.',
            'source_type.required'       => 'Jenis sumber video wajib dipilih.',
            'source_type.in'             => 'Jenis sumber video harus berupa file atau youtube.',
            'video_path.file'            => 'Video harus berupa file yang valid.',
            'video_path.mimes'           => 'Format video harus: mp4, mkv, avi, atau webm.',
            'video_path.max'             => 'Ukuran file video maksimal 200MB.',
            'video_url.required_if'      => 'URL YouTube wajib diisi jika sumber berupa YouTube.',
            'video_url.max'              => 'URL YouTube maksimal 500 karakter.',
            'order.required'             => 'Urutan tampil wajib diisi.',
            'order.integer'              => 'Urutan tampil harus berupa angka.',
            'is_active.required'         => 'Status wajib dipilih.',
            'is_active.boolean'          => 'Status harus berupa aktif atau tidak aktif.',
        ];

        // Jika bukan default, wajib isi start_date dan end_date
        if (!$request->boolean('is_default')) {
            $rules['start_date'] = 'required|date';
            $rules['end_date']   = 'required|date|after_or_equal:start_date';
            $messages['start_date.required']       = 'Tanggal mulai wajib diisi jika bukan video default.';
            $messages['start_date.date']           = 'Tanggal mulai harus berupa tanggal yang valid.';
            $messages['end_date.required']         = 'Tanggal selesai wajib diisi jika bukan video default.';
            $messages['end_date.date']             = 'Tanggal selesai harus berupa tanggal yang valid.';
            $messages['end_date.after_or_equal']   = 'Tanggal selesai harus sama atau setelah tanggal mulai.';
        }

        $request->validate($rules, $messages);

        $videoPath = $video->video_path;
        $youtubeUrl = null;

        // Jika YouTube → convert link
        if ($request->source_type === 'youtube') {
            $converted = $this->convertToYoutubeEmbed($request->video_url);

            if (!$converted) {
                return back()->withErrors(['video_url' => 'Link YouTube tidak valid. Gunakan format seperti: https://www.youtube.com/watch?v=xxxx'])->withInput();
            }

            $youtubeUrl = $converted;

            // Hapus file lama jika sebelumnya file
            if ($videoPath && Storage::disk('public')->exists($videoPath)) {
                Storage::disk('public')->delete($videoPath);
            }
            $videoPath = null;
        }

        // Jika File
        if ($request->source_type === 'file' && $request->hasFile('video_path')) {
            // Hapus file lama
            if ($videoPath && Storage::disk('public')->exists($videoPath)) {
                Storage::disk('public')->delete($videoPath);
            }

            $videoPath = $request->file('video_path')->store('videos', 'public');
        }

        $isDefault = $request->boolean('is_default');

        $video->update([
            'title'       => $request->title,
            'source_type' => $request->source_type,
            'video_path'  => $request->source_type === 'file' ? $videoPath : null,
            'video_url'   => $request->source_type === 'youtube' ? $youtubeUrl : null,
            'order'       => $request->order,
            'is_active'   => $request->is_active,
            'is_default'  => $isDefault,
            'start_date'  => $isDefault ? null : $request->start_date,
            'end_date'    => $isDefault ? null : $request->end_date,
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

    private function convertToYoutubeEmbed($url)
    {
        if (preg_match('/youtube\.com\/embed\//', $url)) {
            return $url;
        }

        $patterns = [
            '/youtu\.be\/([a-zA-Z0-9_-]+)/',                     // youtu.be/ID
            '/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/',         // youtube.com/watch?v=ID
            '/youtube\.com\/shorts\/([a-zA-Z0-9_-]+)/',          // youtube.com/shorts/ID
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $match)) {
                $videoId = $match[1];
                return "https://www.youtube.com/embed/" . $videoId;
            }
        }

        return null; // tidak valid
    }
}
