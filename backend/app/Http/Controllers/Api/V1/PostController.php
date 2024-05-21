<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Filters\V1\PostFilter;
use App\Http\Requests\V1\PostRequest;
use App\Http\Resources\V1\PostResource;
use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use App\Services\PostService;
use Illuminate\Http\Response;
use Throwable;

class PostController extends BaseApiController
{
    public function __construct(protected PostService $postService){}

    public function index(PostFilter $filter)
    {
        $posts = PostResource::collection($this->postService->index($filter));
        return sendResponse(message:'posts list', data:$posts);

        // try {
        //     $posts = PostResource::collection($this->postService->index($filter));
        //     return $posts;
        // } catch (Throwable $exception) {
        //     return new ApiErrorResponse(
        //         'An error occurred while trying to create the user',
        //         $exception
        //     );
        // }
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
