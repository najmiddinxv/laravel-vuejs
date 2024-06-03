<?php

namespace App\Http\Controllers\Backend\Content;

use App\Models\Content\News;
use App\Models\Content\Category;
use Illuminate\Support\Str;
use App\Services\FileUploadService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Content\NewsRequest;
use App\Models\Content\Tag;
use Illuminate\Http\RedirectResponse;

class NewsController extends Controller
{
    public function __construct(protected FileUploadService $fileUploadService){}

    public function index()
    {
        $news = News::with('translations','category','tags')->latest('id')->paginate(config('settings.paginate_per_page'));
		return view('backend.news.index',[
			'news'=>$news,
		]);
    }

    public function create()
    {
        $tags = Tag::newsModel()->get();

        $categories = Category::byModel(News::class)->latest()->get();
        return view('backend.news.create',[
            'categories' => $categories,
            'tags' => $tags,
		]);
    }

    public function store(NewsRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $news = new News();
        $news->category_id = $data['category_id'];
        $news->status = $data['status'];
        $news->slider = $data['slider'];
        $news->save();

        foreach(config('app.locales') as $key => $configLocale){
            $news->translateOrNew($configLocale)->title = $data['title'][$configLocale] ?? $data['title']['uz'];
            $news->translateOrNew($configLocale)->slug = Str::slug($data['title'][$configLocale] ?? $data['title']['uz']);
            $news->translateOrNew($configLocale)->description = $data['description'][$configLocale] ?? $data['description']['uz'];
            $news->translateOrNew($configLocale)->body = $data['body'][$configLocale] ?? $data['description']['uz'];

            if (isset($data['image'][$configLocale])) {
                $news->translateOrNew($configLocale)->main_image = $this->fileUploadService->resizeImageUpload($data['image'][$configLocale], '/uploads/news/' . now()->format('Y/m/d'));
            } else {
                $news->translateOrNew($configLocale)->main_image = null;
            }
            $news->save();
        }
        if(isset($data['tags'])){
            $news->tags()->sync($data['tags']);
        }
        return redirect()->route('backend.news.index')->with('news ',__('lang.successfully_created'));
    }

    public function show(News $news)
    {
        return view('backend.news.show',[
            'news' => $news,
        ]);
    }

    public function edit(News $news)
    {
        $tags = Tag::newsModel()->get();

        $categories = Category::byModel(News::class)->latest()->get();

        return view('backend.news.edit',[
            'news' => $news,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    public function update(NewsRequest $request, News $news): RedirectResponse
    {

        $data = $request->validated();

        $news->category_id = $data['category_id'];
        $news->status = $data['status'];
        $news->slider = $data['slider'];
        $news->save();

        foreach(config('app.locales') as $configLocale){
            $news->translateOrNew($configLocale)->title = $data['title'][$configLocale] ?? $data['title']['uz'];
            $news->translateOrNew($configLocale)->slug = Str::slug($data['title'][$configLocale] ?? $data['title']['uz']);
            $news->translateOrNew($configLocale)->description = $data['description'][$configLocale] ?? $data['description']['uz'];
            $news->translateOrNew($configLocale)->body = $data['body'][$configLocale] ?? $data['description']['uz'];

            if (isset($data['image'][$configLocale])) {
                $this->fileUploadService->resizedImageDelete($news->translate($configLocale)->main_image);
                $news->translateOrNew($configLocale)->main_image = $this->fileUploadService->resizeImageUpload($data['image'][$configLocale], '/uploads/news/' . now()->format('Y/m/d'));
            } else {
                $news->translateOrNew($configLocale)->main_image = $news->translate($configLocale)->main_image;
            }

            $news->save();
        }

        if(isset($data['tags'])){
            $news->tags()->sync($data['tags']);
        }

        return redirect()->route('backend.news.index')->with('news ',__('lang.successfully_created'));

    }

    public function destroy(News $news)
    {
        $this->fileUploadService->resizedImageDelete($news->main_image);
        $news->delete();
        return back()->with('success', 'news ' . __('lang.successfully_deleted'));
    }
}








//https://github.com/Astrotomic/laravel-translatable

// Filling multiple translations
// $data = [
//   'author' => 'Gummibeer',
//   'en' => ['title' => 'My first post'],
//   'fr' => ['title' => 'Mon premier post'],
// ];
// $post = Post::create($data);

// echo $post->translate('fr')->title; // Mon premier post

//shunday saqlash mumkin deb keltirilgan ekan lekin menda nimagadur o'xshamadi faqat bitta til uchun saqlaydigan boldi
// $translatedData = [
//     'category_id' =>  $data['category_id'],
//     'status' =>  $data['status'],
//     'slider' =>  $data['slider'],

//     'uz' => [
//         'title' => $data['title']['uz'],
//         'slug' => Str::slug($data['title']['uz']),
//         'description' => $data['description']['uz'],
//         'body' => $data['body']['uz'],
//         'main_image' => $data['main_image'] ?? null,
//     ],
//     'ru' => [
//         'title' => $data['title']['ru'],
//         'slug' => Str::slug($data['title']['ru']),
//         'description' => $data['description']['ru'],
//         'body' => $data['body']['ru'],
//         'main_image' => $data['main_image'] ?? null,
//     ],
//     'en' => [
//         'title' => $data['title']['en'],
//         'slug' => Str::slug($data['title']['en']),
//         'description' => $data['description']['en'],
//         'body' => $data['body']['en'],
//         'main_image' => $data['main_image'] ?? null,
//     ],

// ];

// //  dd($translatedData);
// News::create($translatedData);
// return redirect()->route('backend.news.index')->with('news ',__('lang.successfully_created'));
