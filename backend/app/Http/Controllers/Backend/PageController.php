<?php

namespace App\Http\Controllers\Backend;

use App\Models\Page;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;
use App\Services\FileUploadService;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function __construct(protected FileUploadService $fileUploadService){}

    public function index()
    {
        $pages = Page::orderBy('id','desc')->paginate(30);
		return view('backend.pages.index',[
			'pages'=>$pages,
		]);
    }

    public function create()
    {
        $categories = Category::where('categoryable_type','App\Models\Page')->orderBy('id','desc')->get();
        return view('backend.pages.create',[
            'categories' => $categories,
		]);
    }

    public function store(PageRequest $request)
    {
        $data = $request->validated();
        if (isset($data['image'])) {
            $data['main_image'] = $this->fileUploadService->resizeImageUpload($data['image'], '/uploads/pages/'.now()->format('Y/m/d'));
        }
        Page::create($data);
        return redirect()->route('backend.pages.index')->with('Page ',__('lang.successfully_created'));
    }

    public function show(Page $page)
    {
        return view('backend.pages.show',[
            'page' => $page,
        ]);
    }

    public function edit(Page $page)
    {
        $categories = Category::where('categoryable_type','App\Models\Page')->orderBy('id','desc')->get();
        return view('backend.pages.edit',[
            'page' => $page,
            'categories' => $categories
        ]);
    }

    public function update(PageRequest $request, Page $page)
    {
        $data = $request->validated();

        if (isset($data['image'])) {
            $this->fileUploadService->resizedImageDelete($page->main_image);
            $data['main_image'] = $this->fileUploadService->resizeImageUpload($data['image'], '/uploads/pages/'.now()->format('Y/m/d'));
        }

        $page->update($data);
        return redirect()->route('backend.pages.index')->with('Page ',__('lang.successfully_updated'));
    }

    public function destroy(Page $page)
    {
        $this->fileUploadService->resizedImageDelete($page->main_image);
        $page->delete();
        return back()->with('success', 'Page ' . __('lang.successfully_deleted'));
    }
}
