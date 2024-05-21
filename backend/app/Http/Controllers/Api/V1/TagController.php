<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\TagRequest;
use App\Http\Resources\V1\TagResource;
use App\Models\Content\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::latest()->paginate(3);
        $tagResource = TagResource::collection($tags);
		return sendResponse(message:'tags list ',data:$tagResource);
    }

    public function show(int $id)
    {
        $tag = Tag::findOrFail($id);
        $tagResource = new TagResource($tag);
		return sendResponse(message:'tags item ', data:$tagResource);
    }

    public function store(TagRequest $request)
    {
        $data = $request->validated();

        $tag = Tag::create($data);
        $tagResource = TagResource::make($tag);
        return sendResponse(code:201, message:'tag '.__('lang.successfully_created'), data:$tagResource);
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
        return sendResponse(code:204, message:'tag '.__('lang.successfully_deleted'));
    }
}
