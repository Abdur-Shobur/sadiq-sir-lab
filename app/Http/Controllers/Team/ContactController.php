<?php
namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = ContactMessage::orderBy('created_at', 'desc')->paginate(10);
        return view('team.contacts.index', compact('contacts'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactMessage $contact)
    {
        return view('team.contacts.show', compact('contact'));
    }
}
