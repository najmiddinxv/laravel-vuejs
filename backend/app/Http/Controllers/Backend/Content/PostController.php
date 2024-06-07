<?php

namespace App\Http\Controllers\Backend\Content;

use App\Models\Content\Post;
use App\Models\Content\Category;
use App\Services\FileUploadService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Content\PostRequest;
use App\Models\Content\Tag;
use DOMDocument;
use Exception;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct(protected FileUploadService $fileUploadService){}

    public function index()
    {
        $posts = Post::latest()->paginate(config('settings.paginate_per_page'));
		return view('backend.posts.index',[
			'posts'=>$posts,
		]);
    }

    public function create()
    {
        $tags = Tag::postModel()->orWhere('tagsable_type',null)->get();
        $categories = Category::byModel(Post::class)->latest()->get();
        return view('backend.posts.create',[
            'categories' => $categories,
            'tags' => $tags,
		]);
    }

    public function store(PostRequest $request)
    {
        $data = $request->validated();

        $this->fileUploadService->processBodyImages(data:$data, locales:config('app.locales'),path:'uploads/posts/' . now()->format('Y/m/d'));

        if (isset($data['image'])) {
            $data['main_image'] = $this->fileUploadService->resizeImageUpload($data['image'], '/uploads/posts/'.now()->format('Y/m/d'));
        }

        $post = Post::create($data);
        if(isset($data['tags'])){
            $post->tags()->sync($data['tags']);
        }

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
        $tags = Tag::postModel()->get();
        $categories = Category::byModel(Post::class)->latest()->get();
        return view('backend.posts.edit',[
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $data = $request->validated();

        if (isset($data['image'])) {
            $this->fileUploadService->resizedImageDelete($post->main_image);
            $data['main_image'] = $this->fileUploadService->resizeImageUpload($data['image'], '/uploads/posts/'.now()->format('Y/m/d'));
        }

        $this->fileUploadService->processBodyImages(data:$data, locales:config('app.locales'),path:'uploads/posts/' . now()->format('Y/m/d'));

        $post->update($data);
        if(isset($data['tags'])){
            $post->tags()->sync($data['tags']);
        }

        return redirect()->route('backend.posts.index')->with('posts ',__('lang.successfully_updated'));
    }

    public function destroy(Post $post)
    {

        $this->fileUploadService->resizedImageDelete($post->main_image);
        $post->delete();
        return back()->with('success', 'post ' . __('lang.successfully_deleted'));
    }
}
