<?php

namespace App\Contracts;

use App\Models\Content\Post;

interface PostServiceContract
{
    public function index(array $data);
    public function show(int $id):Post;
    public function store(array $data);
    public function update(array $data, int $id);
    public function destroy(int $id);
}
