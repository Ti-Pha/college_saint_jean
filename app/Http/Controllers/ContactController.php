<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Http\Requests\ContactMessageRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function store(ContactMessageRequest $request)
    {
        // Sauvegarde du message en base de données
        ContactMessage::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'subject'    => $request->subject,
            'message'    => $request->message,
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.');
    }
}