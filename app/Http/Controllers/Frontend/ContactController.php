<?php

namespace App\Http\Controllers\Frontend;

use App\Events\ContactFormSubmitted;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        try {
            return view('public.contact_us.index');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function contact(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        try {
            Contact::create($validatedData);
            event(new ContactFormSubmitted($validatedData));
            return back()->with('success', 'Message sent successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to send message: ' . $th->getMessage());
        }
    }
}
