<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ImageResize;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function __construct(protected ImageUploadService $imageUploadService){}

    public function index()
    {
        $categories = Category::with('parent')->orderBy('id','desc')->paginate(30);
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

        $image = $data['image'];
        if (isset($image)) {
            $data['image'] = $this->imageUploadService->upload($image, '/uploads/categories');
        }

        Category::create($data);

        return redirect()->route('backend.categories.index')->with('category ',__('lang.successfully_created'));
    }

    public function edit(Category $category)
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return view('backend.categories.edit',[
			'categories' => $categories,
			'category' => $category,
		]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        // if (isset($data['image'])) {
        if ($request->hasFile('image')) {
            $this->imageUploadService->delete($category->image);
            $data['image'] = $this->imageUploadService->upload($request->file('image'), '/uploads/categories');
        }
        $category->update($data);
        return back()->with('success', 'category ' . __('lang.successfully_updated'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'category ' . __('lang.successfully_deleted'));
    }
}
