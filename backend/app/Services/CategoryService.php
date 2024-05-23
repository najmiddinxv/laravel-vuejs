<?php

namespace App\Services;

use App\Contracts\CategoryServiceContract;
use App\Http\Filters\V1\CategoryFilter;
use App\Models\Content\Category;

class CategoryService implements CategoryServiceContract
{
    public function __construct(protected FileUploadService $fileUploadService){}

    public function index(array $queryParam)
    {
        $categories = Category::with(['posts', 'parent', 'children'])
        ->whenJsonColumnLikeForEachWord('name', $queryParam['name'])
        ->whereNull('parent_id')
        ->latest()
        ->paginate($queryParam['per_page'] ?? 30);

        return $categories;
    }

    public function show(int $id)
    {
        $category = Category::findOrFail($id);
        return $category;
    }

    public function store(array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = $this->fileUploadService->resizeImageUpload($data['image'], '/uploads/categories/'.now()->format('Y/m/d'));
        }
        $category = Category::create($data);
        return $category;
    }

    public function update(array $data, int $id)
    {
        $category = Category::findOrFail($id);
        if (isset($data['image'])) {
            $this->fileUploadService->resizedImageDelete($category->image);
            $data['image'] = $this->fileUploadService->resizeImageUpload($data['image'], '/uploads/categories/'.now()->format('Y/m/d'));
        }
        $category->update($data);
        return $category;
    }

    public function destroy(int $id)
    {
        $category = Category::findOrFail($id);
        if(!is_null($category->image)){
            $this->fileUploadService->resizedImageDelete($category->image);
        }
        $category->delete();
    }

}
