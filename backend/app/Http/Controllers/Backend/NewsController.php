<?php

namespace App\Http\Controllers\Backend;

use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use App\Services\FileUploadService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class NewsController extends Controller
{
    public function __construct(protected FileUploadService $fileUploadService){}

    public function index()
    {
        $news = News::orderBy('id','desc')->paginate(30);
		return view('backend.news.index',[
			'news'=>$news,
		]);
    }



    public function create()
    {
        $categories = Category::where('categoryable_type','App\Models\News')->orderBy('id','desc')->get();
        return view('backend.news.create',[
            'categories' => $categories,
		]);
    }

    public function store(NewsRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if (isset($data['image'])) {
            $data['main_image'] = $this->fileUploadService->resizeImageUpload($data['image'], '/uploads/news');
        }

        $tanslatedData = [
            'uz' => [
                'title' => $data['title']['uz'],
                'slug' => Str::slug($data['title']['uz']),
                'description' => $data['description']['uz'],
                'body' => $data['body']['uz'],
                'main_image' => $data['main_image'] ?? null,
            ],
            'ru' => [
                'title' => $data['title']['ru'],
                'slug' => Str::slug($data['title']['ru']),
                'description' => $data['description']['ru'],
                'body' => $data['body']['ru'],
                'main_image' => $data['main_image'] ?? null,
            ],
            'en' => [
                'title' => $data['title']['en'],
                'slug' => Str::slug($data['title']['en']),
                'description' => $data['description']['en'],
                'body' => $data['body']['en'],
                'main_image' => $data['main_image'] ?? null,
            ],
            'category_id' => $data['category_id'],
            'status' => $data['status'],
            'slider' => $data['slider'],
        ];
        dd($tanslatedData);
        News::create($tanslatedData);
        return redirect()->route('backend.news.index')->with('news ',__('lang.successfully_created'));



        // dd($data);
        // $post->translate('en')->title = 'My cool post';

        // $data['slug'] = [
        //     'uz' => Str::slug($data['title']['uz']),
        //     'ru' => Str::slug($data['title']['ru']),
        //     'en' => Str::slug($data['title']['en']),
        // ];


        // $article = new News();
        // $article->online = true;
        // $article->save();

        // foreach (['en', 'nl', 'fr', 'de'] as $locale) {
        //     $article->translateOrNew($locale)->name = "Title {$locale}";
        //     $article->translateOrNew($locale)->text = "Text {$locale}";
        // }

        // $article->save();


        //yokida
        // $article_data = [
        //     'en' => [
        //         'title'       => $request->input('en_title'),
        //         'full_text' => $request->input('en_full_text')
        //     ],
        //     'es' => [
        //         'title'       => $request->input('es_title'),
        //         'full_text' => $request->input('es_full_text')
        //     ],
        //  ];

        //  // Now just pass this array to regular Eloquent function and Voila!
        //  News::create($article_data);


//         $post->translate('en')->title = 'My cool post';
// $post->save();


// $data = [
//     'author' => 'Gummibeer',
//     'en' => ['title' => 'My first post'],
//     'fr' => ['title' => 'Mon premier post'],
//   ];
//   $post = Post::create($data);

//   echo $post->translate('fr')->title; // Mon premier post

        // $article->getTranslation('fr')->text;
        // yoki
        // app()->setLocale('fr');
        // $article->text;

    }

    public function show(News $news)
    {
        return view('backend.news.show',[
            'news' => $news,
        ]);
    }

    public function edit(News $news)
    {
        $categories = Category::where('categoryable_type','App\Models\News')->orderBy('id','desc')->get();
        return view('backend.news.edit',[
            'news' => $news,
            'categories' => $categories
        ]);
    }

    public function update(NewsRequest $request, News $news): RedirectResponse
    {

        return redirect()->route('posts.index');
    }

    public function destroy(News $news)
    {
        $this->fileUploadService->resizedImageDelete($news->main_image);
        $news->delete();
        return back()->with('success', 'news ' . __('lang.successfully_deleted'));
    }
}
