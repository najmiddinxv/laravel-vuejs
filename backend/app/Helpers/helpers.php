<?php

function sendResponse($message,$code = 200, $data = [])
{
    $response = [
        'success' => true,
        'code' => $code,
        'message' => $message,
        'data'    => $data,
    ];

    return response()->json($response, $code);
}

function sendError($message, $code = 404, $data = [])
{
    $response = [
        'success' => false,
        'code' => $code,
        'message' => $message,
    ];

    if(!empty($data)){
        $response['data'] = $data;
    }

    return response()->json($response, $code);
}
