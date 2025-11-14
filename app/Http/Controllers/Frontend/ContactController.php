<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    // ADMIN - List semua contact
    public function index()
    {
        $contacts = Contact::latest()->paginate(20);
        return view('admin.contacts.index', compact('contacts'));
    }

    // USER - Submit contact form
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($request->all());

        return back()->with('success', 'Pesan berhasil dikirim!');
    }
}
