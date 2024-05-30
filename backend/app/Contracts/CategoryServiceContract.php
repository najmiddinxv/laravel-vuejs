<?php

namespace App\Contracts;

interface CategoryServiceContract
{
    public function index(array $queryParam);
    public function show(int $id);
    public function store(array $data);
    public function update(array $data, int $id);
    public function destroy(int $id);
}
