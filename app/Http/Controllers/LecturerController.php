<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    public function index(Request $request)
    {
        $search  = $request->input('search');
        $entries = $request->input('entries', 10);

        $lecturers = Lecturer::query()
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%")
                                        ->orWhere('email', 'like', "%{$search}%")
                                        ->orWhere('nidn', 'like', "%{$search}%"))
            ->orderBy('created_at', 'desc')
            ->paginate($entries)
            ->appends(compact('search', 'entries'));

        return view('lecturers.index', compact('lecturers', 'search', 'entries'));
    }

    public function create()
    {
        return view('lecturers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nidn' => 'nullable|string|max:30|unique:lecturers,nidn',
            'email' => 'nullable|email|max:255|unique:lecturers,email',
            'phone' => 'nullable|string|max:30',
        ]);

        Lecturer::create($validated);

        return redirect()->route('lecturers.index')->with('success', 'Lecturer berhasil dibuat.');
    }

    public function edit(Lecturer $lecturer)
    {
        return view('lecturers.edit', compact('lecturer'));
    }

    public function update(Request $request, Lecturer $lecturer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nidn' => "nullable|string|max:30|unique:lecturers,nidn,{$lecturer->id}",
            'email' => "nullable|email|max:255|unique:lecturers,email,{$lecturer->id}",
            'phone' => 'nullable|string|max:30',
        ]);

        $lecturer->update($validated);

        return redirect()->route('lecturers.index')->with('success', 'Lecturer berhasil diperbarui.');
    }

    public function destroy(Lecturer $lecturer)
    {
        $lecturer->delete();
        return redirect()->route('lecturers.index')->with('success', 'Lecturer berhasil dihapus.');
    }
}
