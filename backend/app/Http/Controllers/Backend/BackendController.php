<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackendController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('permission:data-all|data-create|data-edit|data-show|data-delete', ['only' => ['index']]);
//        $this->middleware('permission:data-create|data-all', ['only' => ['create','store']]);
//        $this->middleware('permission:data-show|data-all', ['only' => ['show']]);
//        $this->middleware('permission:data-edit|data-all', ['only' => ['edit','update']]);
//        $this->middleware('permission:data-delete|data-all', ['only' => ['destroy']]);
//
//    }

    public function index()
    {
        return view("backend.index");
    }
}
