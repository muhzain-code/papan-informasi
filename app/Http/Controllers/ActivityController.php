<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $entries = $request->entries ?? 10;
        $search  = $request->search ?? '';

        $query = Activity::with('causer')->latest();

        if ($search != '') {
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%$search%")
                    ->orWhere('subject_type', 'like', "%$search%")
                    ->orWhereHas('causer', function ($u) use ($search) {
                        $u->where('name', 'like', "%$search%");
                    });
            });
        }

        $activities = $query->paginate($entries)->withQueryString();

        return view('activity.index', compact('activities', 'entries', 'search'));
    }
    
    public function show($id)
    {
        $activity = Activity::with(['causer'])->findOrFail($id);

        return view('activity.show', compact('activity'));
    }
}
