<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;
use App\Notifications\NewContactNotification;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

   public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contact = Contact::create($request->all());

        // Kirim notifikasi ke admin
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewContactNotification($contact));
        }

        return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim!');
    }
}
