<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Http\Request;

interface UserServiceContract
{
    public function index(Request $request);
    public function show(int $id):User;
    public function store(array $data);
    public function update(array $data, int $id);
    public function destroy(int $id);
}
