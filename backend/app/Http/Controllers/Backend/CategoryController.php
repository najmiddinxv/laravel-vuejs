<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id','desc')->paginate(30);
		return view('backend.categories.index',[
			'categories'=>$categories,
		]);
    }

    public function create()
    {
        return view('backend.categories.create',[

		]);
    }

    public function store(CategoryRequest $request)
    {
        //
    }

    // public function show(Category $category)
    // {
    //     return view('backend.categories.show',[
	// 		'category' => $category,
	// 	]);
    // }

    public function edit(Category $category)
    {
        return view('backend.categories.edit',[
			'category' => $category,
		]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        //
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'category ' . __('lang.successfully_deleted'));
    }
}
