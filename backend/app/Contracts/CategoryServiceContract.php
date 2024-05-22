<?php

namespace App\Contracts;

use App\Http\Filters\V1\CategoryFilter;
use App\Models\Content\Post;

interface CategoryServiceContract
{
    public function index(CategoryFilter $filter);
    public function show(int $id);
    public function store(array $data);
    public function update(array $data, int $id);
    public function destroy(int $id);
}
