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
        protected JsonplaceholderApiService $jsonplaceholderApiService
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
        // if (isset($data['image'])) {
        //     $data['image'] = $this->fileUploadService->resizeImageUpload($data['image'], '/uploads/categories/'.now()->format('Y/m/d'));
        // }
        // $category = Category::create($data);
        // return $category;




        //jsonplaceholderApiga yaratilgan kategory idsi bo'yicha post yaratish
        if (isset($data['image'])) {
            $data['image'] = $this->fileUploadService->resizeImageUpload($data['image'], '/uploads/categories/'.now()->format('Y/m/d'));
        }

        $category = Category::create($data);

        //apidan 1 dona post olinib yuoqirda yaratilgan category uchun bitta yangi post yaratilayapti
        // $jsonplaceholderPost = $this->jsonplaceholderApiService->getPost(random_int(1,100));
        try {
            $jsonplaceholderPost = $this->jsonplaceholderApiService->getPost(random_int(1, 100));
        } catch (\Exception $e) {
            sendError(500, $e->getMessage());
        }

        $postDTO = PostDTO::from([
            'category_id' => $category->id,
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

        //agar category_id ni PostDTO ning ichida nullable qilsak
        //$postDTO->toArray() category_id=nullable bop qolayapti bu error beradi chunki databaseda null emas shuni remove qilsak keyin bazaga yozadi
        // $postArr = $postDTO->toArray();
        // $post = data_forget($postArr, 'category_id');

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

    // public function index(array $queryParam)
    // {
    //     $perPage = $queryParam['per_page'] ?? config('settings.paginate_per_page');
    //     $sortParams = Arr::only($queryParam, ['id', 'created_at']); //quey paramsdan sortirovka uchun mo'ljallanga columnlar alohida olinayapti
    //     // dd($sortParams);

    //     $categories = Category::with(['parent', 'children'])
    //     ->withCount('posts')
    //     ->whereNull('parent_id')

    //     //yoki umumiy bo'lmagan filterlarni shu yerga yozsak bo'ladi
    //     ->when(isset($queryParam['categoryable_type']), function ($query) use ($queryParam) {
    //         return $query->where('categoryable_type', '=', $queryParam['categoryable_type']);
    //     })

    //     //tablelar uchun umumiy bo'lgan columnlarni filter qilish uchun macros yozsak bo'ladi
    //     // patdagi tartibda
    //     ->whenJsonColumnLikeForEachWord('name', $queryParam) //macros bu
    //     // ->whenJsonColumnLike('name', $queryParam) //macros bu
    //     // ->sortBy('id',$queryParam) //macros bu
    //     // ->sortBy('created_at',$queryParam) //macros bu
    //     //yoki bir qancha columnlar bo'yicha birdan sortirovka qilsak bo'ladi
    //     ->sortByArr($sortParams) // bu macros. Apply sorting for multiple fields
    //     // ->latest()
    //     ->paginate($perPage);

    //     return $categories;
    // }


}
