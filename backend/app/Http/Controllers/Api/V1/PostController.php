<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Filters\V1\PostFilter;
use App\Http\Requests\V1\PostRequest;
use App\Http\Resources\V1\PostCollection;
use App\Http\Resources\V1\PostResource;
use App\Services\JsonplaceholderApiService;
use App\Services\PostService;
use Throwable;

class PostController extends BaseApiController
{
    public function __construct(
        protected PostService $postService,
        protected JsonplaceholderApiService $jsonplaceholderApiService,
    ){}

    public function index(PostFilter $filter)
    {
        try {
            $posts = new PostCollection($this->postService->index($filter));
            return sendResponse(message:'posts list', data:$posts);
        } catch (Throwable $exception) {
            return sendError(data:$exception->getMessage());
        }
    }

    public function show(int $id)
    {
        // $post = new PostResource($this->postService->show($id));
        // return sendResponse(message:'post item', data: $post);

        $post = $this->postService->show($id);
        $comments = $this->jsonplaceholderApiService->getComments($id);
        $post->jsonplaceholderComments = $comments;
        $postResource = new PostResource($post);
        return sendResponse(message:'post item', data: $postResource);
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
