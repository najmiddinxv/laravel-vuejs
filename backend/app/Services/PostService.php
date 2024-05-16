<?php

namespace App\Services;

use App\Contracts\PostServiceContract;
use App\Models\Post;

class PostService implements PostServiceContract
{
    public function __construct(protected FileUploadService $fileUploadService){}

    public function index(array $data)
    {
        // $lang = app()->getLocale();
        // $titleSortBy = strtoupper($data['titleSortBy'] ?? null);
        // $query = Post::query()
        //     ->with('category')
        //     ->when(isset($data['title']), function ($query) use ($data,$lang) {
        //         $query->where("title->{$lang}", 'ILIKE', '%'.$data['title'].'%');
        //     })->when(isset($titleSortBy), function ($query) use ($titleSortBy,$lang) {
        //         $query->orderByRaw("title->>'{$lang}' {$titleSortBy}");
        //     })
        //     ->when(isset($data['createdAt']), function ($query) use ($data) {
        //         $query->orderBy('created_at', $data['createdAt']);
        //     })->when(isset($data['viewCount']), function ($query) use ($data) {
        //         $query->orderBy('view_count', $data['viewCount']);
        //     });

        // $perPage = $data['perPage'] ?? 20;
        // $posts = isset($data['listType']) && $data['listType'] === 'collection' ? $query->get() : $query->paginate($perPage);

        $posts = Post::latest('id')->paginate(50);
        return $posts;
    }


    public function store(array $data)
    {
        if (isset($data['image'])) {
            $data['main_image'] = $this->fileUploadService->resizeImageUpload($data['image'], '/uploads/posts/'.now()->format('Y/m/d'));
        }

        $post = Post::create($data);
        if(isset($data['tags'])){
            $post->tags()->sync($data['tags']);
        }

        return $post;
    }

    public function show(int $id):Post
    {
        $post = Post::find($id);
        return $post;
    }

    public function update(array $data, $id)
    {
        $post = Post::find($id);

        if (isset($data['image'])) {
            $this->fileUploadService->resizedImageDelete($post->main_image);
            $data['main_image'] = $this->fileUploadService->resizeImageUpload($data['image'], '/uploads/posts/'.now()->format('Y/m/d'));
        }

        $post->update($data);
        if(isset($data['tags'])){
            $post->tags()->sync($data['tags']);
        }

        return $post;
    }

    public function destroy(int $id)
    {
        $post = Post::find($id);
        $this->fileUploadService->resizedImageDelete($post->main_image);
        $post->delete();
        return back()->with('success', 'post ' . __('lang.successfully_deleted'));
    }

}
