<?php

namespace App\Services;

use App\Contracts\CategoryServiceContract;
use App\DTO\PostDTO;
use App\Models\Content\Category;

class CategoryService implements CategoryServiceContract
{
    public function __construct(
        protected FileUploadService $fileUploadService,
        protected JsonplaceholderApiService $jsonplaceholderApiService,
    ){}

    public function index(array $queryParam)
    {
        $perPage = $queryParam['per_page'] ?? config('settings.paginate_per_page');

        $categories = Category::with(['parent', 'children'])
        ->withCount('posts')
        ->whenJsonColumnLikeForEachWord('name', $queryParam)
        // ->whenJsonColumnLike('name', $queryParam)
        ->whereNull('parent_id')
        // ->latest()
        ->sortBy('order',$queryParam)
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


        $jsonplaceholderPost = $this->jsonplaceholderApiService->getPost(random_int(1,100));
        $postDTO = PostDTO::from([
            'titleUz' => $jsonplaceholderPost->title
        ]);

        $category->posts()->create($postDTO->toArray());

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
