<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\NewsServiceContract;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\V1\NewsRequest;
use App\Http\Resources\V1\NewsCollection;
use App\Http\Resources\V1\NewsResource;

class NewsController extends BaseApiController
{
    public function __construct(
        protected NewsServiceContract $newsService,
    ){}

    public function index(NewsRequest $request)
    {
        $queryParam = $request->validated();
        $posts = new NewsCollection($this->newsService->index($queryParam));
        return sendResponse(message:'posts list', data:$posts);
    }

    public function show(int $id)
    {
        $post = new NewsResource($this->newsService->show($id));
        return sendResponse(message:'post item', data: $post);
    }

    public function store(NewsRequest $request)
    {
        $data = $request->validated();
        $post = new NewsResource($this->newsService->store($data));
        return sendResponse(code:201, message:'post '.__('lang.successfully_created'), data:$post);
    }

    public function update(NewsRequest $request, int $id)
    {
        $data = $request->validated();
        $post = new NewsResource($this->newsService->update($data, $id));
        return sendResponse(message:'post '.__('lang.successfully_updated'), data:$post);
    }

    public function destroy(int $id)
    {
        $this->newsService->destroy($id);
        return sendResponse(code:200, message:'post '.__('lang.successfully_deleted'));
    }
}
