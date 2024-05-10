<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('id','desc')->paginate(30);
		return view('backend.tags.index',[
			'tags'=>$tags,
		]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'tagsable_type' => 'nullable|string|max:255',
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

        Tag::create([
            'tagsable_type' => $request->tagsable_type,
            'name' => $request->name,
        ]);

        return redirect()->route('backend.tags.index')->with('success','tags ' . __('lang.successfully_created'));
    }

    public function edit(Tag $tag)
    {
		return view('backend.tags.edit',[
			'tag'=>$tag,
		]);
    }

    public function update(Request $request, Tag $tag)
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

        $tag->update([
            'tagsable_type' => $request->tagsable_type,
            'name' => $request->name,
        ]);

        return redirect()->route('backend.tags.index')->with('success','tags ' . __('lang.successfully_updated'));
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->back()->with('success',__('lang.successfully_deleted'));
    }
}
