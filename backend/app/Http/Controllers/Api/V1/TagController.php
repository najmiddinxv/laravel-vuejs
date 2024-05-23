<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\TagRequest;
use App\Http\Resources\V1\TagCollection;
use App\Http\Resources\V1\TagResource;
use App\Models\Content\Tag;
use Illuminate\Http\Response;

class TagController extends BaseApiController
{
    public function index(TagRequest $request)
    {
        $queryParam = $request->validated();
        $lang = app()->getLocale();

        // $tags = Tag::when(isset($queryParam['name']),function($query) use ($lang, $queryParam){
        //     $query->where("name->$lang", 'ILIKE', '%'.$queryParam['name'].'%');
        // })
        $tags = Tag::query()
            ->whenNameLike($queryParam, $lang)
            ->latest()
            ->paginate($queryParam['per_page'] ?? 30);

        $tagCollection = new TagCollection($tags);
		return sendResponse(message:'tags list',data:$tagCollection);
    }

    public function show(int $id)
    {
        $tag = Tag::findOrFail($id);
        $tagResource = new TagResource($tag);
		return sendResponse(message:'tags item', data:$tagResource);
    }

    public function store(TagRequest $request)
    {
        $data = $request->validated();

        $tag = Tag::create($data);
        $tagResource = TagResource::make($tag);
        return sendResponse(code:Response::HTTP_CREATED, message:'tag '.__('lang.successfully_created'), data:$tagResource);
    }

    public function update(TagRequest $request, int $id)
    {
        $data = $request->validated();

        $tag = Tag::findOrFail($id);
        $tag->update($data);
        $tagResource = new TagResource($tag);
        return sendResponse(message:'tag '.__('lang.successfully_updated'), data:$tagResource);
    }

    public function destroy(int $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        return sendResponse(code:Response::HTTP_NO_CONTENT, message:'tag '.__('lang.successfully_deleted'));
    }
}
