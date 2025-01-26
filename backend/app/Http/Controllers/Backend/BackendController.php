<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use MyHelperFacade;

class BackendController extends Controller
{
    public function index()
    {
//        $result = MyHelperFacade::greet('Najmiddin');
//        echo $result; die; // Output: Hello, Najmiddin

        return view("backend.index");
    }
}
