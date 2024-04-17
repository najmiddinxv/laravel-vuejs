<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WordController extends Controller
{
    public function index()
    {
        $words = Word::orderBy('id','desc')->paginate(30);
		return view('backend.words.index',[
			'words'=>$words,
		]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'key' => 'required|string|max:255',
            'value.uz' => ['required'],
            'value.*' => [
                'nullable',
                'string',
                'max:255',
                // 'unique:tags,name->'.app()->getLocale(),
            ],
		]);

        if ($validator->fails()) {
			return back()->withErrors($validator)->withInput();
		}

        Word::create([
            'key' => $request->key,
            'value' => $request->value,
        ]);

        return redirect()->route('backend.words.index')->with('success','word ' . __('lang.successfully_created'));

    }

    public function edit(Word $word)
    {
        return view('backend.words.edit',[
			'word'=>$word,
		]);
    }

    public function update(Request $request, Word $word)
    {
        $validator = Validator::make($request->all(),[
            'key' => 'required|string|max:255',
            'value.uz' => ['required'],
            'value.*' => [
                'nullable',
                'string',
                'max:255',
                // 'unique:tags,name->'.app()->getLocale(),
            ],
		]);

        if ($validator->fails()) {
			return back()->withErrors($validator)->withInput();
		}

        $word->update([
            'key' => $request->key,
            'value' => $request->value,
        ]);

        return redirect()->route('backend.words.index')->with('success','word ' . __('lang.successfully_updated'));

    }

    public function destroy(Word $word)
    {
        $word->delete();
        return redirect()->back()->with('success', 'word ' . __('lang.successfully_deleted'));
    }
}
