<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $entries = $request->input('entries', 10);

        $notifications = Notification::query()
            ->when($search, function ($query) use ($search) {
                $query->where('message', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate($entries)
            ->appends([
                'search' => $search,
                'entries' => $entries,
            ]);

        return view('notifications.index', compact('notifications', 'search', 'entries'));
    }


    public function create()
    {
        return view('notifications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'date' => 'required|date',
        ], [
            'message.required' => 'Pesan notifikasi wajib diisi.',
            'date.required'    => 'Tanggal wajib diisi.',
            'date.date'        => 'Format tanggal tidak valid.',
        ]);

        Notification::create([
            'message' => $request->message,
            'date' => $request->date,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('notifications.index')->with('success', 'Notification berhasil dibuat.');
    }

    public function show(Notification $notification)
    {
        return view('notifications.show', compact('notification'));
    }

    public function edit(Notification $notification)
    {
        return view('notifications.edit', compact('notification'));
    }

    public function update(Request $request, Notification $notification)
    {
        $request->validate([
            'message' => 'required',
            'date' => 'required|date',
        ], [
            'message.required' => 'Pesan notifikasi wajib diisi.',
            'date.required'    => 'Tanggal wajib diisi.',
            'date.date'        => 'Format tanggal tidak valid.',
        ]);

        $notification->update([
            'message' => $request->message,
            'date' => $request->date,
        ]);

        return redirect()->route('notifications.index')->with('success', 'Notification berhasil diperbarui.');
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();

        return redirect()->route('notifications.index')->with('success', 'Notification berhasil dihapus.');
    }
}
