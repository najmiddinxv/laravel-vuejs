<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class BaseApiController extends Controller
{
    public function index(Request $request)
    {

        // $data = PostResource::collection(User::all());
        // return sendResponse('user list', data:$data);
        return sendResponse("BaseApi");
    }


}
