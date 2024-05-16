<?php

namespace App\Http\Controllers\Backend\Content;

use App\Models\Content\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Content\CategoryRequest;
use App\Services\FileUploadService;

class CategoryController extends Controller
{
    public function __construct(protected FileUploadService $fileUploadService){}

    public function index()
    {
        $categories = Category::with('parent')->latest('id')->paginate(30);
		return view('backend.categories.index',[
			'categories'=>$categories,
		]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.categories.create',[
            'categories' => $categories,
		]);
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        if (isset($data['image'])) {
            $data['image'] = $this->fileUploadService->resizeImageUpload($data['image'], '/uploads/categories/'.now()->format('Y/m/d'));
        }

        Category::create($data);

        return redirect()->route('backend.categories.index')->with('category ',__('lang.successfully_created'));
    }

    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('backend.categories.edit',[
			'categories' => $categories,
			'category' => $category,
		]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $this->fileUploadService->resizedImageDelete($category->image);
            $data['image'] = $this->fileUploadService->resizeImageUpload($request->file('image'), '/uploads/categories/'.now()->format('Y/m/d'));
        }
        $category->update($data);
        return back()->with('success', 'category ' . __('lang.successfully_updated'));
    }

    public function destroy(Category $category)
    {
        $this->fileUploadService->resizedImageDelete($category->image);
        $category->delete();
        return back()->with('success', 'category ' . __('lang.successfully_deleted'));
    }
}
