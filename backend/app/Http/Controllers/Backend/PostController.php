<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

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
        // dd($request->all());
        $data = $request->validated();
        if (isset($data['image'])) {
            $data['main_image'] = $this->fileUploadService->resizeImageUpload($data['image'], '/uploads/posts');
        }
        Post::create($data);
        return redirect()->route('backend.post.index')->with('post ',__('lang.successfully_created'));
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
        //
    }

    public function destroy(Post $post)
    {
        $this->fileUploadService->resizedImageDelete($post->image);
        $post->delete();
        return back()->with('success', 'post ' . __('lang.successfully_deleted'));
    }
}
