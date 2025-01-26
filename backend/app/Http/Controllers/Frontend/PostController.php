<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Content\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(config('settings.paginate'));
        return view('frontend.posts.index',[
            'posts' => $posts
        ]);
    }
    public function show($slug)
    {
        $lang = app()->getLocale();

        $post = Post::with(['tags','comments'])->where("slug->{$lang}",$slug)->firstOrFail();

        $post->increment('view_count');

        //cookie orqali postning view countini oshirish
        //bunda browserning cookie vaqti tugamaguncha faqat bir marta increment qiladi
        // if (!request()->cookie('post_'.$post->id)) {
        //     $post->increment('view_count');
        //     cookie()->queue('post_'.$post->id, true, 60*24*30);
        // }

        $prevPost = Post::find($post->id - 1);
        $nextPost = Post::find($post->id + 1);

        return view('frontend.posts.show',[
            'post' => $post,
            'prevPost' => $prevPost,
            'nextPost' => $nextPost
        ]);
    }

    public function byTag($tagId)
    {
        $posts = Post::whereHas('tags', function ($query) use ($tagId) {
            $query->where('tags.id', $tagId);
        })->paginate(config('settings.paginate'));

        return view('frontend.posts.byTag', [
            'posts' => $posts
        ]);
    }
}
