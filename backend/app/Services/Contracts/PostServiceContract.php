<?php

namespace App\Services\Contracts;


use Illuminate\Http\Request;

interface PostServiceContract
{
    public function index(Request $request);
}
