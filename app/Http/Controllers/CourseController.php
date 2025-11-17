<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $search  = $request->input('search');
        $entries = $request->input('entries', 10);

        $courses = Course::query()
            ->when($search, fn($q) => $q->where('code', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%"))
            ->orderBy('created_at', 'desc')
            ->paginate($entries)
            ->appends(compact('search', 'entries'));

        return view('courses.index', compact('courses', 'search', 'entries'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:20|unique:courses,code',
            'name' => 'required|string|max:255',
            'sks'  => 'required|integer|min:1|max:10',
            'description' => 'nullable|string',
        ]);

        Course::create($validated);

        return redirect()->route('courses.index')->with('success', 'Course berhasil dibuat.');
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'code' => "required|string|max:20|unique:courses,code,{$course->id}",
            'name' => 'required|string|max:255',
            'sks'  => 'required|integer|min:1|max:10',
            'description' => 'nullable|string',
        ]);

        $course->update($validated);

        return redirect()->route('courses.index')->with('success', 'Course berhasil diperbarui.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course berhasil dihapus.');
    }
}
