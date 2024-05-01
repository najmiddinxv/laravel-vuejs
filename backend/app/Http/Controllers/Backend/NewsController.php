<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(NewsRequest $request)
    {
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
        //
    }

    public function edit(News $news)
    {
        //
    }

    public function update(NewsRequest $request, News $news)
    {
        //
    }

    public function destroy(News $news)
    {
        //
    }
}
