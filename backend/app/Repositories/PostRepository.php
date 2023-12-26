<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryContract;

class PostRepository implements PostRepositoryContract
{
    public function store($data)
    {
        return Post::create($data);
    }
}
