<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    public function index(Request $request)
    {
        $search  = $request->input('search');
        $entries = $request->input('entries', 10);

        $infos = Info::query()
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate($entries)
            ->appends([
                'search'  => $search,
                'entries' => $entries,
            ]);

        return view('infos.index', compact('infos', 'search', 'entries'));
    }


    public function create()
    {
        return view('infos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'message' => 'required',
            'date'    => 'nullable|date',
            'status'  => 'required|in:active,inactive',
        ]);

        Info::create([
            'title'      => $request->title,
            'message'    => $request->message,
            'date'       => $request->date,
            'status'     => $request->status,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('infos.index')->with('success', 'Info berhasil dibuat.');
    }

    public function show(Info $info)
    {
        return view('infos.show', compact('info'));
    }

    public function edit(Info $info)
    {
        return view('infos.edit', compact('info'));
    }

    public function update(Request $request, Info $info)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'message' => 'required',
            'date'    => 'nullable|date',
            'status'  => 'required|in:active,inactive',
        ]);

        $info->update([
            'title'      => $request->title,
            'message'    => $request->message,
            'date'       => $request->date,
            'status'     => $request->status,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('infos.index')->with('success', 'Info berhasil diperbarui.');
    }

    public function destroy(Info $info)
    {
        $info->update(['deleted_by' => Auth::id()]);
        $info->delete();

        return redirect()->route('infos.index')->with('success', 'Info berhasil dihapus.');
    }
}
