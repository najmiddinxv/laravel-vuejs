<?php

namespace App\Http\Controllers\Backend\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ContactRequest;
use App\Models\Content\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('id','desc')->paginate(30);
		return view('backend.contacts.index',[
			'contacts' => $contacts,
		]);
    }

    //frontend controllerlaridan biriga yozamiz
    // public function store(ContactRequest $request)
    // {
    //     $data = $request->validated();
    //     Contact::create($data);
    //     return redirect()->route('backend.contacts.index')->with('contacts ',__('lang.successfully_created'));
    // }

    public function show(Contact $contact)
    {
        return view('backend.contacts.show',[
			'contact' => $contact,
		]);
    }

    public function update(ContactRequest $request, Contact $contact)
    {
        $data = $request->validated();
        $contact->update($data);
        return back()->with('success', 'contact ' . __('lang.successfully_updated'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return back()->with('success', 'contact ' . __('lang.successfully_deleted'));
    }
}
