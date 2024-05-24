<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\V1\CategoryRequest;
use App\Http\Resources\V1\CategoryCollection;
use App\Http\Resources\V1\CategoryResource;
use App\Services\CategoryService;

class CategoryController extends BaseApiController
{
    public function __construct(protected CategoryService $categoryService){}

    public function index(CategoryRequest $request)
    {
        $queryParam = $request->validated();
        $posts = new CategoryCollection($this->categoryService->index($queryParam));
        return sendResponse(message:'categories list', data:$posts);
    }

    public function show(int $id)
    {
        $post = new CategoryResource($this->categoryService->show($id));
        return sendResponse(message:'category item', data: $post);
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $post = new CategoryResource($this->categoryService->store($data));
        return sendResponse(code:201, message:'category '.__('lang.successfully_created'), data:$post);
    }

    public function update(CategoryRequest $request, int $id)
    {
        $data = $request->validated();
        $post = new CategoryResource($this->categoryService->update($data, $id));
        return sendResponse(message:'category '.__('lang.successfully_updated'), data:$post);
    }

    public function destroy(int $id)
    {
        $this->categoryService->destroy($id);
        return sendResponse(message:'category '.__('lang.successfully_deleted'));
    }
}
