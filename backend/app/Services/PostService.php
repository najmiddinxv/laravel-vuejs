<?php

namespace App\Services;

use App\Contracts\PostServiceContract;
use App\DTO\JsonplaceholderPostDTO;
use App\Http\Filters\V1\PostFilter;
use App\Models\Content\Post;

class PostService implements PostServiceContract
{
    public function __construct(
        protected FileUploadService $fileUploadService,
        protected JsonplaceholderApiService $jsonplaceholderApiService,
    ){}

    public function index(PostFilter $filter)
    {
        $posts = Post::with('category', 'tags')->getByFilter($filter);
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

        // $jsonPlaceHolderPost = JsonplaceholderPostDTO::from([
        //     'userId' => $post->created_by,
        //     'title' => $post->title,
        //     'body' => $post->body,
        // ]);


        // dd($jsonPlaceHolderPost);

        // $this->jsonplaceholderApiService->storePost($jsonPlaceHolderPost);

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
        return $post->delete();
    }

}
