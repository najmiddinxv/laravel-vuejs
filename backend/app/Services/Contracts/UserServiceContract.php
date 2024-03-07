<?php

namespace App\Services\Contracts;


use Illuminate\Http\Request;

interface UserServiceContract
{
    public function index(Request $request);
}
