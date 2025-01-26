<?php
use Illuminate\Http\JsonResponse;

/**
 * Send a successful JSON response.
 *
 * @param int $code
 * @param string|null $message
 * @param mixed $data
 * @return JsonResponse
 */
function sendResponse(int $code = 200, string $message = null, mixed $data = null): JsonResponse
{
    $response = [
        'success' => true,
        'code' => $code,
        'message' => $message ?? 'ok',
        'data' => $data,
    ];

    return response()->json($response, $code);
}

/**
 * Send an error JSON response.
 *
 * @param int $code
 * @param string|null $message
 * @param mixed $data
 * @return JsonResponse
 */
function sendError(int $code = 404, string $message = null, mixed $data = null): JsonResponse
{
    $response = [
        'success' => false,
        'code' => $code,
        'message' => $message ?? 'An error occurred',
    ];

    if (!is_null($data)) {
        $response['data'] = $data;
    }

    return response()->json($response, $code);
}
