<?php

namespace App\Repositories\Contracts;

use App\Models\Post;

interface PostRepositoryContract
{
    public function store(array $data);
}
