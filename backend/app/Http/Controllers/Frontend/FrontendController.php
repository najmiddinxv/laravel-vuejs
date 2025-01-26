<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Content\Post;
use Illuminate\Support\Facades\Cache;

class FrontendController extends Controller
{
    public function index()
    {
        $banners = Cache::rememberForever('banners', function () {
            return Post::activeBanner()
                ->latest('id')
                ->limit(3)
                ->get();
        });

        return view("frontend.index",[
            'banners' => $banners
        ]);
    }
}
