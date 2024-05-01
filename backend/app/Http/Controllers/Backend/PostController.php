<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Services\FileUploadService;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function __construct(protected FileUploadService $fileUploadService){}

    public function index()
    {
        $posts = Post::orderBy('id','desc')->paginate(30);
		return view('backend.posts.index',[
			'posts'=>$posts,
		]);
    }

    public function create()
    {
        $categories = Category::where('categoryable_type','App\Models\Post')->orderBy('id','desc')->get();
        return view('backend.posts.create',[
            'categories' => $categories,
		]);
    }

    public function store(PostRequest $request)
    {
        $data = $request->validated();
        if (isset($data['image'])) {
            $data['main_image'] = $this->fileUploadService->resizeImageUpload($data['image'], '/uploads/posts');
        }
        // $data['slug'] = [
        //     'uz' => Str::slug($data['title']['uz']),
        //     'ru' => Str::slug($data['title']['ru']),
        //     'en' => Str::slug($data['title']['en']),
        // ];
        Post::create($data);
        return redirect()->route('backend.posts.index')->with('post ',__('lang.successfully_created'));
    }

    public function show(Post $post)
    {
        return view('backend.posts.show',[
            'post' => $post,
        ]);
    }

    public function edit(Post $post)
    {
        $categories = Category::where('categoryable_type','App\Models\Post')->orderBy('id','desc')->get();
        return view('backend.posts.edit',[
            'post' => $post,
            'categories' => $categories
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $data = $request->validated();

        if (isset($data['image'])) {
            $this->fileUploadService->resizedImageDelete($post->main_image);
            $data['main_image'] = $this->fileUploadService->resizeImageUpload($data['image'], '/uploads/posts');
        }

        $post->update($data);
        return redirect()->route('backend.posts.index')->with('posts ',__('lang.successfully_updated'));
    }

    public function destroy(Post $post)
    {
        $this->fileUploadService->resizedImageDelete($post->main_image);
        $post->delete();
        return back()->with('success', 'post ' . __('lang.successfully_deleted'));
    }
}
