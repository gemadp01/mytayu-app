<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Mail;

class ContactController extends Controller
{
    public function store(Request $request) {
        $validatedData = $request->validate([
            'nama' => 'required',
            'email' => 'required|email:dns',
            'subject' => 'required',
            'message' => 'required',
        ]);

        Mail::to($validatedData['email'])->send(new ContactMail($validatedData));

        return redirect()->back()->with(['success' => 'Thank you for contact us!']);
    }
}
