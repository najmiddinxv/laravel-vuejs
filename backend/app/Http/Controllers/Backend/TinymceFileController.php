<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TinymceFile;
use Illuminate\Http\Request;

class TinymceFileController extends Controller
{
    public function index()
    {
        $tinymceFiles = TinymceFile::orderBy('id','desc')->paginate(30);
		return view('backend.tinymceFiles.index',[
			'tinymceFiles'=>$tinymceFiles,
		]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(TinymceFile $tinymceFile)
    {
        //
    }

    public function update(Request $request, TinymceFile $tinymceFile)
    {
        //
    }

    public function destroy(TinymceFile $tinymceFile)
    {
        $tinymceFile->delete();
        return back()->with('success', 'File ' . __('lang.successfully_deleted'));
    }
}
