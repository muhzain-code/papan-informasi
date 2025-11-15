<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $search  = $request->input('search');
        $entries = $request->input('entries', 10); 
        
        $settings = Setting::query()
            ->when($search, function ($query) use ($search) {
                $query->where('key', 'like', "%{$search}%")
                    ->orWhere('value', 'like', "%{$search}%");
            })
            ->orderBy('key', 'asc')
            ->paginate($entries)
            ->appends([
                'search'  => $search,
                'entries' => $entries
            ]);

        return view('settings.index', compact('settings', 'search', 'entries'));
    }


    public function edit(Setting $setting)
    {
        return view('settings.edit', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $validated = $request->validate([
            'value' => 'nullable|string',
        ]);

        $setting->update($validated);

        return redirect()->route('settings.index')->with('success', 'Setting berhasil diperbarui!');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:255|unique:settings,key',
            'value' => 'nullable|string',
        ]);

        Setting::create($validated);

        return redirect()->route('settings.index')->with('success', 'Setting baru berhasil ditambahkan!');
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();
        return redirect()->route('settings.index')->with('success', 'Setting berhasil dihapus!');
    }
}
