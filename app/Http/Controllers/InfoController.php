<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    public function index()
    {
        $data = Info::latest()->paginate(10);
        return view('infos.index', compact('data'));
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
