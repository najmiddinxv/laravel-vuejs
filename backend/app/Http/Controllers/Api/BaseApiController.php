<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class BaseApiController extends Controller
{
    public function baseApiIndex()
    {
        return 'index';
    }

}
