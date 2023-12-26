<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(protected PostService $postService)
    {
    }

    public function index(Request $request)
    {
         $posts = PostResource::collection($this->postService->index($request));
         return sendResponse('user list', data:$posts);
    }


}
