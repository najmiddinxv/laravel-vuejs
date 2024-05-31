<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\Content\News;
use App\Models\Content\Post;
use App\Http\Filters\V1\PostFilter;
use App\Contracts\NewsServiceContract;

class NewsService implements NewsServiceContract
{
    public function __construct(
        protected FileUploadService $fileUploadService
    ){}

    public function index(array $queryParam)
    {
        $perPage = $queryParam['per_page'] ?? config('settings.paginate_per_page');
        $sortParams = Arr::only($queryParam, ['view_count', 'created_at']);

        $news = News::query()
            // ->select('id')
            // ->with('translations:id,news_id,locale,title')
            // ->with(['translations' => function ($query) {
            //     $query->select('news_id', 'title', 'slug', 'description', 'main_image'); // Ensure 'news_id' is included
            // }])
            ->whenJsonColumnLikeForEachWord('title', $queryParam)
            ->sortByArr($sortParams)
            ->latest()
            ->paginate($perPage);

        return $news;
    }
    public function store(array $data)
    {
        if (isset($data['image'])) {
            $data['main_image'] = $this->fileUploadService->resizeImageUpload($data['image'], '/uploads/news/'.now()->format('Y/m/d'));
        }

        $news = new News();
        $news->category_id = $data['category_id'];
        $news->status = $data['status'];
        $news->slider = $data['slider'];
        $news->save();
        $languages = config('app.locales');
        foreach($languages as $key => $configLocale){
            $news->translateOrNew($configLocale)->title = $data['title'][$configLocale] ?? $data['title']['uz'];
            $news->translateOrNew($configLocale)->slug = Str::slug($data['title'][$configLocale] ?? $data['title']['uz']);
            $news->translateOrNew($configLocale)->description = $data['description'][$configLocale] ?? $data['description']['uz'];
            $news->translateOrNew($configLocale)->body = $data['body'][$configLocale] ?? $data['description']['uz'];
            $news->translateOrNew($configLocale)->main_image = $data['main_image'] ?? null;
            $news->save();
        }
        if(isset($data['tags'])){
            $news->tags()->sync($data['tags']);
        }
        return $news;
    }

    public function show(int $id):News
    {
        return News::findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $news = News::find($id);

        if (isset($data['image'])) {
            $this->fileUploadService->resizedImageDelete($news->main_image);
            $data['main_image'] = $this->fileUploadService->resizeImageUpload($data['image'], '/uploads/news/'.now()->format('Y/m/d'));
        }else{
            $data['main_image'] = $news->main_image;
        }

        $news->category_id = $data['category_id'];
        $news->status = $data['status'];
        $news->slider = $data['slider'];
        $news->save();

        foreach(config('app.locales') as $configLocale){
            $news->translateOrNew($configLocale)->title = $data['title'][$configLocale] ?? $data['title']['uz'];
            $news->translateOrNew($configLocale)->slug = Str::slug($data['title'][$configLocale] ?? $data['title']['uz']);
            $news->translateOrNew($configLocale)->description = $data['description'][$configLocale] ?? $data['description']['uz'];
            $news->translateOrNew($configLocale)->body = $data['body'][$configLocale] ?? $data['description']['uz'];
            $news->translateOrNew($configLocale)->main_image = $data['main_image'] ?? null;
            $news->save();
        }

        if(isset($data['tags'])){
            $news->tags()->sync($data['tags']);
        }

        return $news;
    }

    public function destroy(int $id)
    {
        $news = News::find($id);
        $this->fileUploadService->resizedImageDelete($news->main_image);
        return $news->delete();
    }
}
