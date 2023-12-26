<?php

namespace App\Services;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use App\Services\Contracts\PostServiceContract;

class PostService implements PostServiceContract
{
    public function index($request)
    {
        return User::all();
    }
}
