<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Course;
use App\Models\Lecturer;
use App\Models\Room;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $search  = $request->input('search');
        $entries = $request->input('entries', 10);

        $schedules = Schedule::with(['course', 'lecturer', 'room'])
            ->when($search, fn($q) => $q->whereHas('course', fn($q2) => $q2->where('name', 'like', "%{$search}%"))
                ->orWhereHas('lecturer', fn($q2) => $q2->where('name', 'like', "%{$search}%"))
                ->orWhereHas('room', fn($q2) => $q2->where('name', 'like', "%{$search}%")))
            ->orderBy('created_at', 'desc')
            ->paginate($entries)
            ->appends(compact('search', 'entries'));

        return view('schedules.index', compact('schedules', 'search', 'entries'));
    }

    public function show(Schedule $schedule)
    {
        $schedule->load(['course', 'lecturer', 'room']);

        return view('schedules.show', compact('schedule'));
    }

    public function create()
    {
        $courses = Course::all();
        $lecturers = Lecturer::all();
        $rooms = Room::all();

        return view('schedules.create', compact('courses', 'lecturers', 'rooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'lecturer_id' => 'required|exists:lecturers,id',
            'room_id' => 'required|exists:rooms,id',
            'day_of_week' => 'required|integer|min:1|max:7',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        Schedule::create($validated);

        return redirect()->route('schedules.index')->with('success', 'Schedule berhasil dibuat.');
    }

    public function edit(Schedule $schedule)
    {
        $courses = Course::all();
        $lecturers = Lecturer::all();
        $rooms = Room::all();

        return view('schedules.edit', compact('schedule', 'courses', 'lecturers', 'rooms'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'lecturer_id' => 'required|exists:lecturers,id',
            'room_id' => 'required|exists:rooms,id',
            'day_of_week' => 'required|integer|min:1|max:7',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        $schedule->update($validated);

        return redirect()->route('schedules.index')->with('success', 'Schedule berhasil diperbarui.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Schedule berhasil dihapus.');
    }
}
