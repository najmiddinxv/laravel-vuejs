<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\V1\TagRequest;
use App\Http\Resources\V1\TagCollection;
use App\Http\Resources\V1\TagEditResource;
use App\Http\Resources\V1\TagResource;
use App\Models\Content\Tag;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;

class TagController extends BaseApiController
{
    public function index(TagRequest $request)
    {
        $queryParam = $request->validated();
        // $perPage = $queryParam['per_page'] ?? Config::get('settings.paginate_per_page'); // Config::set('settings.per_page', 20);
        $perPage = $queryParam['per_page'] ?? 5; // Config::set('settings.per_page', 20);

        $tags = Tag::query()
            ->whenJsonColumnLike('name', $queryParam)
            ->latest()
            ->paginate($perPage);

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

    public function edit(int $id)
    {
        $tag = Tag::findOrFail($id);
        $tagEditResource = new TagEditResource($tag);
		return sendResponse(message:'tags item', data:$tagEditResource);
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
        return sendResponse(code:200, message:'tag '.__('lang.successfully_deleted'));
    }
}
