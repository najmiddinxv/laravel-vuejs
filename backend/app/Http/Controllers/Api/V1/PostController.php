<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends BaseApiController
{
    public function __construct(protected PostService $postService){}

    public function index(PostRequest $request)
    {
        $data = $request->validated();
        $posts = PostResource::collection($this->postService->index($data));
        return sendResponse(message:'posts list', data:$posts);
    }

    public function show(int $id)
    {
        $post = $this->postService->show($id);
        return sendResponse(message:'post item', data:new PostResource($post));
    }

    public function store(PostRequest $request)
    {
        $data = $request->validated();
        $post = $this->postService->store($data);
        return sendResponse(code:201, message:'post '.__('lang.successfully_created'), data:new PostResource($post));
    }

    public function update(PostRequest $request, int $id)
    {
        $data = $request->validated();
        $post = $this->postService->update($data, $id);
        return sendResponse(message:'post '.__('lang.successfully_updated'), data:new PostResource($post));
    }

    public function destroy(int $id)
    {
        $this->postService->destroy($id);
        return sendResponse(code:204, message:'post '.__('lang.successfully_deleted'));
    }

}
