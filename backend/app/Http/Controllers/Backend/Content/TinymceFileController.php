<?php

namespace App\Http\Controllers\Backend\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Content\TinymceFileRequest;
use App\Models\Content\Category;
use App\Models\Content\TinymceFile;
use App\Services\FileUploadService;

class TinymceFileController extends Controller
{
    public function __construct(protected FileUploadService $fileUploadService){}

    public function index()
    {
        $tinymceFiles = TinymceFile::latest()->paginate(30);
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

        foreach ($data['files'] as $fileItem) {
            $fileUploadServiceResponse = $this->fileUploadService->fileAndImageUpload($fileItem, '/uploads/files/'.now()->format('Y/m/d'));
            $data['path'] = $fileUploadServiceResponse[0];
            // $data['mime_type'] = $data['file']->getClientMimeType();
            // $data['size'] = $data['file']->getSize();
            // $data['mime_type'] = $data['file']->getClientOriginalExtension();
            $data['mime_type'] = $fileItem->getClientOriginalExtension();
            $data['size'] = $fileUploadServiceResponse[1];
            $data['uploaded_by'] = auth()->user()->id;
            TinymceFile::create($data);
        }

        return redirect()->route('backend.tinymceFiles.index')->with('file ',__('lang.successfully_created'));
    }

    public function edit(TinymceFile $tinymceFile)
    {
        $categories = Category::where('categoryable_type','App\Models\TinymceFile')->orderBy('id','desc')->get();
        return view('backend.tinymceFiles.edit',[
            'categories' => $categories,
            'tinymceFile' => $tinymceFile,
		]);
    }

    public function update(TinymceFileRequest $request, TinymceFile $tinymceFile)
    {
        $data = $request->validated();
        $tinymceFile->update($data);
        return back()->with('success', 'File ' . __('lang.successfully_updated'));
    }

    public function destroy(TinymceFile $tinymceFile)
    {
        $this->fileUploadService->fileAndImageDelete($tinymceFile->path);
        $tinymceFile->delete();
        return back()->with('success', 'File ' . __('lang.successfully_deleted'));
    }

}
