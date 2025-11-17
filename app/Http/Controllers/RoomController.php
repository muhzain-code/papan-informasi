<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $search  = $request->input('search');
        $entries = $request->input('entries', 10);

        $rooms = Room::query()
            ->when($search, fn($q) => $q->where('code', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%"))
            ->orderBy('created_at', 'desc')
            ->paginate($entries)
            ->appends(compact('search', 'entries'));

        return view('rooms.index', compact('rooms', 'search', 'entries'));
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:rooms,code',
            'name' => 'nullable|string|max:255',
            'capacity' => 'required|integer|min:1|max:9999',
        ]);

        Room::create($validated);

        return redirect()->route('rooms.index')->with('success', 'Room berhasil dibuat.');
    }

    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'code' => "required|string|max:50|unique:rooms,code,{$room->id}",
            'name' => 'nullable|string|max:255',
            'capacity' => 'required|integer|min:1|max:9999',
        ]);

        $room->update($validated);

        return redirect()->route('rooms.index')->with('success', 'Room berhasil diperbarui.');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Room berhasil dihapus.');
    }
}
