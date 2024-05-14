<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class BaseApiController extends Controller
{
    public function baseApiIndex()
    {
        return 'index';
    }

    // public function sendResponse($code = 200, $message = null, $data = [])
    // {
    //     $response = [
    //         'success' => true,
    //         'code' => $code,
    //         'message' => $message,
    //         'data'    => $data,
    //     ];

    //     return response()->json($response, $code);
    // }

    // public function sendError($code = 404, $message = null,  $data = [])
    // {
    //     $response = [
    //         'success' => false,
    //         'code' => $code,
    //         'message' => $message,
    //     ];

    //     if(!empty($data)){
    //         $response['data'] = $data;
    //     }

    //     return response()->json($response, $code);
    // }

}
