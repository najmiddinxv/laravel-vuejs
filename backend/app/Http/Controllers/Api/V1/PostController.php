<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\PostServiceContract;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Filters\V1\PostFilter;
use App\Http\Requests\V1\PostRequest;
use App\Http\Resources\V1\PostCollection;
use App\Http\Resources\V1\PostResource;
use App\Services\JsonplaceholderApiService;
use Throwable;

class PostController extends BaseApiController
{
    public function __construct(
        protected PostServiceContract $postService,
        protected JsonplaceholderApiService $jsonplaceholderApiService,
    ){}

    public function index(PostFilter $filter)
    {
        $posts = new PostCollection($this->postService->index($filter));
        return sendResponse(message:'posts list', data:$posts);
    }

    public function show(int $id)
    {
        // $post = new PostResource($this->postService->show($id));
        // return sendResponse(message:'post item', data: $post);



        //jsonplaceholderApisidan bizning bazamizdagi postni id ge teng bo'lgan commentlarni olish xolati
        $post = $this->postService->show($id);
        $comments = $this->jsonplaceholderApiService->getComments($id);
        $post->jsonplaceholderComments = $comments;
        $postResource = new PostResource($post);
        return sendResponse(message:'post item', data: $postResource);
    }

    public function store(PostRequest $request)
    {
        // $data = $request->validated();
        // $post = new PostResource($this->postService->store($data));
        // return sendResponse(code:201, message:'post '.__('lang.successfully_created'), data:$post);


        
        //jsonplaceholder apisiga post store qilish varianti
        $data = $request->validated();
        $postStored = $this->postService->store($data);
        $postResource = new PostResource($postStored['post']);
        $postAndJsonPlaseholderStoredResponse = [
            'post' => $postResource,
            'jsonplaceholderResponse' => $postStored['jsonplaceholderResponse']
        ];
        return sendResponse(code:201, message:'post '.__('lang.successfully_created'), data:$postAndJsonPlaseholderStoredResponse);
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
        return sendResponse(code:200, message:'post '.__('lang.successfully_deleted'));
    }

    //try catchni ishlatish. lekin men handler/exception.php ga yozib qo'yibman shuning uchun hamma joyga buni yozish shart emas
    // public function index(PostFilter $filter)
    // {
    // use Throwable;
    //     try {
    //         $posts = new PostCollection($this->postService->index($filter));
    //         return sendResponse(message:'posts list', data:$posts);
    //     } catch (Throwable $exception) {
    //         return sendError(data:$exception->getMessage());
    //     }
    // }
}
