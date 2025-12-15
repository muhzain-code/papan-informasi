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

    public function show(Lecturer $lecturer)
    {
        return view('lecturers.show', compact('lecturer'));
    }

    public function create()
    {
        return view('lecturers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|string|max:255',
                'nidn' => 'required|string|max:30|unique:lecturers,nidn',
                'email' => 'required|email|max:255|unique:lecturers,email',
                'phone' => 'required|string|max:30',
            ],
            [
                'name.required' => 'Nama dosen wajib diisi.',
                'name.max'      => 'Nama dosen tidak boleh lebih dari 255 karakter.',

                'nidn.max'      => 'NIDN tidak boleh melebihi 30 karakter.',
                'nidn.unique'   => 'NIDN sudah terdaftar, silakan gunakan yang lain.',
                'nidn.required' => 'NIDN wajib diisi.',

                'email.required' => 'Email wajib diisi.',
                'phone.required' => 'Phone wajib diisi.',

                'email.email'   => 'Format email tidak valid.',
                'email.max'     => 'Email tidak boleh lebih dari 255 karakter.',
                'email.unique'  => 'Email sudah digunakan, silakan gunakan yang lain.',

                'phone.max'     => 'Nomor telepon tidak boleh lebih dari 30 karakter.',
            ],
        );

        Lecturer::create($validated);

        return redirect()->route('lecturers.index')->with('success', 'Lecturer berhasil dibuat.');
    }

    public function edit(Lecturer $lecturer)
    {
        return view('lecturers.edit', compact('lecturer'));
    }

    public function update(Request $request, Lecturer $lecturer)
    {
        $validated = $request->validate(
            [
                'name' => 'required|string|max:255',
                'nidn' => "required|string|max:30|unique:lecturers,nidn,{$lecturer->id}",
                'email' => "required|email|max:255|unique:lecturers,email,{$lecturer->id}",
                'phone' => 'required|string|max:30',
            ],
            [
                'name.required' => 'Nama dosen wajib diisi.',
                'name.max'      => 'Nama dosen tidak boleh lebih dari 255 karakter.',

                'nidn.max'      => 'NIDN tidak boleh melebihi 30 karakter.',
                'nidn.unique'   => 'NIDN sudah terdaftar, silakan gunakan yang lain.',
                'nidn.required' => 'NIDN wajib diisi.',
                'email.required' => 'Email wajib diisi.',
                'phone.required' => 'Phone wajib diisi.',

                'email.email'   => 'Format email tidak valid.',
                'email.max'     => 'Email tidak boleh lebih dari 255 karakter.',
                'email.unique'  => 'Email sudah digunakan, silakan gunakan yang lain.',

                'phone.max'     => 'Nomor telepon tidak boleh lebih dari 30 karakter.',
            ]
        );

        $lecturer->update($validated);

        return redirect()->route('lecturers.index')->with('success', 'Lecturer berhasil diperbarui.');
    }

    public function destroy(Lecturer $lecturer)
    {
        $lecturer->delete();
        return redirect()->route('lecturers.index')->with('success', 'Lecturer berhasil dihapus.');
    }
}
