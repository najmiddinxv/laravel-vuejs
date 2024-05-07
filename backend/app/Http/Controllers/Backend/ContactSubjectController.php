<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContactSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactSubjectController extends Controller
{
    public function index()
    {
        $contactSubjects = ContactSubject::orderBy('id','desc')->paginate(30);
		return view('backend.contactSubjects.index',[
			'contactSubjects'=>$contactSubjects,
		]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name.uz' => ['required'],
            'name.*' => [
                'nullable',
                'string',
                'max:255',
                // 'unique:tags,name->'.app()->getLocale(),
            ],
		]);

        if ($validator->fails()) {
			return back()->withErrors($validator)->withInput();
		}

        ContactSubject::create($request->all());

        return redirect()->route('backend.contact-subjects.index')->with('success','tags ' . __('lang.successfully_created'));
    }

    public function edit(ContactSubject $contactSubject)
    {
		return view('backend.contactSubjects.edit',[
			'contactSubject'=>$contactSubject,
		]);
    }

    public function update(Request $request, ContactSubject $contactSubject)
    {
        $validator = Validator::make($request->all(),[
            'name.uz' => ['required'],
            'name.*' => [
                'nullable',
                'string',
                'max:255',
            ],
		]);

        if ($validator->fails()) {
			return back()->withErrors($validator)->withInput();
		}

        $contactSubject->update($request->all());

        return redirect()->route('backend.contact-subjects.index')->with('success','tags ' . __('lang.successfully_updated'));
    }

    public function destroy(ContactSubject $contactSubject)
    {
        $contactSubject->delete();
        return redirect()->back()->with('success',__('lang.successfully_deleted'));
    }
}
