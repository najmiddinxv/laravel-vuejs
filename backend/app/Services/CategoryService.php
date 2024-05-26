<?php

namespace App\Services;

use App\DTO\PostDTO;
use Illuminate\Support\Str;
use App\Models\Content\Category;
use App\Contracts\CategoryServiceContract;
use App\Models\Content\Tag;
use Illuminate\Support\Arr;

class CategoryService implements CategoryServiceContract
{
    public function __construct(
        protected FileUploadService $fileUploadService,
        protected JsonplaceholderApiService $jsonplaceholderApiService,
    ){}

    public function index(array $queryParam)
    {
        $perPage = $queryParam['per_page'] ?? config('settings.paginate_per_page');
        $sortParams = Arr::only($queryParam, ['id', 'created_at']); // Adjust as needed
        // dd($sortParams);

        $categories = Category::with(['parent', 'children'])
        ->withCount('posts')
        ->whereNull('parent_id')

        ->whenJsonColumnLikeForEachWord('name', $queryParam) //macros bu
        // ->whenJsonColumnLike('name', $queryParam) //macros bu
        // ->sortBy('id',$queryParam) //macros bu
        // ->sortBy('created_at',$queryParam) //macros bu
        //yoki
        ->sortByArr($sortParams) // Apply sorting for multiple fields
        // ->latest()
        // ->orderBy('created_at',$queryParam['created_at'])
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



        //apidan 1 dona post olinib yuoqirda yaratilgan category uchun bitta yangi post yaratilayapti
        // $jsonplaceholderPost = $this->jsonplaceholderApiService->getPost(random_int(1,100));


        try {
            $jsonplaceholderPost = $this->jsonplaceholderApiService->getPost(random_int(1, 100));
        } catch (\Exception $e) {
            // \Log::error('Error fetching post: ' . $e->getMessage());
            // return response()->json(['success' => false, 'code' => 500, 'message' => 'Error fetching post']);
            sendError(500, $e->getMessage());
        }

        $postDTO = PostDTO::from([
            'categoryId' => $category->id,
            'title' => [
                'uz' => 'uz title '.$jsonplaceholderPost['title'],
                'ru' => 'ru title '.$jsonplaceholderPost['title'],
                'en' => 'en title '.$jsonplaceholderPost['title'],
            ],
            'description' => [
                'uz' => 'uz title '.Str::limit($jsonplaceholderPost['body'],50),
                'ru' => 'ru title '.Str::limit($jsonplaceholderPost['body'],50),
                'en' => 'en title '.Str::limit($jsonplaceholderPost['body'],50),
            ],
            'body' => [
                'uz' => 'uz title '.$jsonplaceholderPost['body'],
                'ru' => 'ru title '.$jsonplaceholderPost['body'],
                'en' => 'en title '.$jsonplaceholderPost['body'],
            ],
            'tags' => Tag::select('id')->inRandomOrder()->limit(3)->pluck('id')->toArray()

        ]);

        // dd($postDTO->toArray());
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
