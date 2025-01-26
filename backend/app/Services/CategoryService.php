<?php

namespace App\Services;

use App\Models\Content\Category;
use App\Contracts\CategoryServiceContract;
use Illuminate\Support\Arr;

class CategoryService implements CategoryServiceContract
{
    public function __construct(
        protected FileUploadService $fileUploadService
    ){}

    public function index(array $queryParam)
    {
        $perPage = $queryParam['per_page'] ?? config('settings.paginate_per_page');
        $sortParams = Arr::only($queryParam, ['id', 'created_at']);

        $categories = Category::with(['parent', 'children'])
        ->withCount('posts')
        ->whereNull('parent_id')
        ->when(isset($queryParam['categoryable_type']), function ($query) use ($queryParam) {
            return $query->where('categoryable_type', '=', $queryParam['categoryable_type']);
        })
        ->whenJsonColumnLikeForEachWord('name', $queryParam)
        ->sortByArr($sortParams)
        ->paginate($perPage);

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
