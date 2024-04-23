<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TinymceFileRequest;
use App\Models\Category;
use App\Models\TinymceFile;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class TinymceFileController extends Controller
{
    public function __construct(protected FileUploadService $fileUploadService){}

    public function index()
    {
        $tinymceFiles = TinymceFile::orderBy('id','desc')->paginate(30);
		return view('backend.tinymceFiles.index',[
			'tinymceFiles'=>$tinymceFiles,
		]);
    }

    public function create()
    {
        $categories = Category::where('categoryable_type','App\Models\TinymceFile')->orderBy('id','desc')->get();
        return view('backend.tinymceFiles.create',[
            'categories' => $categories,
		]);
    }

    public function store(TinymceFileRequest $request)
    {
        $data = $request->validated();
        $fileUploadServiceResponse = $this->fileUploadService->fileUpload($data['file'], '/uploads/tinymceFiles');
        $data['path'] = $fileUploadServiceResponse[0];
        // $data['mime_type'] = $data['file']->getClientMimeType();
        // $data['size'] = $data['file']->getSize();
        $data['mime_type'] = $data['file']->getClientOriginalExtension();
        $data['size'] = $fileUploadServiceResponse[1];
        $data['uploaded_by'] = auth()->user()->id;
        TinymceFile::create($data);
        return redirect()->route('backend.tinymceFiles.index')->with('file ',__('lang.successfully_created'));
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
