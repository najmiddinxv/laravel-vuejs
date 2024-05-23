<?php

namespace App\Macros;

use Illuminate\Http\Response;

class HelperMethodsMacros
{

    public static function sendResponse()
    {
        Response::macro('sendResponse', function (int $code = 200, string $message = null, mixed $data = null) {
            return Response::json([
                'success' => true,
                'code' => $code,
                'message' => $message ?? 'ok',
                'data' => $data ?? [],
            ], $code);
        });
    }
    //controllerda shu tartibda ishlatiladi
    //return response()->sendResponse(201, 'created', $data);
    //return response()->sendError(201, 'created', $data);
    public static function sendError()
    {
        Response::macro('sendError', function (int $code = 404, string $message = null, mixed $data = null) {
            $response = [
                'success' => false,
                'code' => $code,
                'message' => $message ?? 'An error occurred',
            ];

            if (!is_null($data)) {
                $response['data'] = $data;
            }
            return Response::json($response, $code);
        });
    }

}
