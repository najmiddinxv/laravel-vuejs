<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
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

    public function store(Request $request)
    {
        // $article = new News();
        // $article->online = true;
        // $article->save();

        // foreach (['en', 'nl', 'fr', 'de'] as $locale) {
        //     $article->translateOrNew($locale)->name = "Title {$locale}";
        //     $article->translateOrNew($locale)->text = "Text {$locale}";
        // }

        // $article->save();

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

    public function update(Request $request, News $news)
    {
        //
    }

    public function destroy(News $news)
    {
        //
    }
}
