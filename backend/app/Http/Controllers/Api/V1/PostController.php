<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Filters\V1\PostFilter;
use App\Http\Requests\V1\PostRequest;
use App\Http\Resources\V1\PostCollection;
use App\Http\Resources\V1\PostResource;
use App\Models\Content\Post;
use App\Services\PostService;

class PostController extends BaseApiController
{
    public function __construct(protected PostService $postService){}

    public function index(PostFilter $filter)
    {
        $posts = new PostCollection($this->postService->index($filter));
        return sendResponse(message:'posts list', data:$posts);

        // try {
        //     $posts = PostResource::collection($this->postService->index($filter));
        //     return $posts;
        // } catch (Throwable $exception) {
        //     return sendError(
        //         message:'An error occurred while trying to create the user',
        //         $exception
        //     );
        // }
    }

    public function show(int $id)
    {
        $post = new PostResource($this->postService->show($id));
        return sendResponse(message:'post item', data: $post);
    }

    public function store(PostRequest $request)
    {
        $data = $request->validated();
        $post = new PostResource($this->postService->store($data));
        return sendResponse(code:201, message:'post '.__('lang.successfully_created'), data:$post);
    }

    public function update(PostRequest $request, int $id)
    {
        $data = $request->validated();
        $post = new PostResource($this->postService->update($data, $id));
        return sendResponse(message:'post '.__('lang.successfully_updated'), data:$post);
    }

    public function destroy(int $id)
    {
        $this->postService->destroy($id);
        return sendResponse(code:204, message:'post '.__('lang.successfully_deleted'));
    }

}
