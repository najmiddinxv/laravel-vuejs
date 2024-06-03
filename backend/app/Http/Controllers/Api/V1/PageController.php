<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\PageServiceContract;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\V1\PageRequest;
use App\Http\Resources\V1\PageCollection;
use App\Http\Resources\V1\PageResource;
use Exception;

class PageController extends BaseApiController
{
    public function __construct(protected PageServiceContract $pageService){}

    public function index(PageRequest $request)
    {
        $queryParam = $request->validated();
        $posts = new PageCollection($this->pageService->index($queryParam));
        return sendResponse(message:'pages list', data:$posts);
    }

    public function show(int $id)
    {
        $post = new PageResource($this->pageService->show($id));
        return sendResponse(message:'page item', data: $post);
    }

    public function store(PageRequest $request)
    {
        $data = $request->validated();
        $post = new PageResource($this->pageService->store($data));
        return sendResponse(code:201, message:'page '.__('lang.successfully_created'), data:$post);
    }

    public function update(PageRequest $request, int $id)
    {
        $data = $request->validated();
        $post = new PageResource($this->pageService->update($data, $id));
        return sendResponse(message:'page '.__('lang.successfully_updated'), data:$post);
    }

    public function destroy(int $id)
    {
        $this->pageService->destroy($id);
        // return response()->noContent(); // This sets the status code to 204
        return sendResponse(message:'page '.__('lang.successfully_deleted'));
    }
}
