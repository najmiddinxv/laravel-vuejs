<?php

namespace App\Contracts;

use App\Http\Filters\V1\PostFilter;
use App\Models\Content\Post;

interface PostServiceContract
{
    public function index(PostFilter $filter);
    public function show(int $id):Post;
    public function store(array $data);
    public function update(array $data, int $id);
    public function destroy(int $id);
}
