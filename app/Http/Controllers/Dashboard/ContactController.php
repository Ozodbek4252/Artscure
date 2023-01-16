<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(20);
        return view('dashboard.contact.index', ['contacts'=>$contacts]);
    }

    public function destroy($id)
    {
        try {
            $contact = Contact::find($id);
            $contact->delete();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('contacts.index');
    }

}

