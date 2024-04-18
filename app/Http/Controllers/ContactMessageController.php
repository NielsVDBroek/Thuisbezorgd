<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    
    public function index()
    {
        $messages = ContactMessage::all();
        return view('contact.contact-messages', compact('messages'));
    }

    public function create()
    {
        return view('contact.contact');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        $contact = new ContactMessage($validated);

        if (auth()->check()) {
            $contact->user_id = auth()->id(); // Automatically attach user id if logged in
            $contact->name = auth()->user()->name;
            $contact->email = auth()->user()->email;
        } else {
            $validated += $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
            ]);
            $contact->fill($validated);
        }

        $contact->save();

        return redirect()->route('home.main')->with('success', 'Message sent successfully!');
    }

    public function destroy($id)
    {
        $contactMessage = ContactMessage::findOrFail($id);
        $contactMessage->delete();

        return redirect()->route('contact.contact-messages')->with('success', 'Message deleted successfully!');
    }
}
