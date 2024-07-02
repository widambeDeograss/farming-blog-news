<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Mail\ContactUsMail;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:12',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contact = ContactUs::create($request->all());

        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        Mail::to('info@molagribusinessltd.com')->send(new ContactUsMail($details));

        return response()->json(['message' => 'Your message has been sent successfully.'], 200);
    }
}

