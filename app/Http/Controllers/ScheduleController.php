<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $data = Schedule::latest()->paginate(10);
        return view('schedules.index', compact('data'));
    }

    public function create()
    {
        return view('schedules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'place'    => 'nullable|string|max:255',
            'start_at' => 'nullable|date',
            'end_at'   => 'nullable|date|after_or_equal:start_at',
            'is_active' => 'required|boolean',
        ]);

        Schedule::create([
            'title'      => $request->title,
            'place'      => $request->place,
            'start_at'   => $request->start_at,
            'end_at'     => $request->end_at,
            'is_active'  => $request->is_active,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil dibuat.');
    }

    public function show(Schedule $schedule)
    {
        return view('schedules.show', compact('schedule'));
    }

    public function edit(Schedule $schedule)
    {
        return view('schedules.edit', compact('schedule'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'place'    => 'nullable|string|max:255',
            'start_at' => 'nullable|date',
            'end_at'   => 'nullable|date|after_or_equal:start_at',
            'is_active' => 'required|boolean',
        ]);

        $schedule->update([
            'title'      => $request->title,
            'place'      => $request->place,
            'start_at'   => $request->start_at,
            'end_at'     => $request->end_at,
            'is_active'  => $request->is_active,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->update(['deleted_by' => Auth::id()]);
        $schedule->delete();

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
