<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\V1\AuthLoginRequest;
use App\Models\User;
use App\Models\VerificationCode;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthApiController extends BaseApiController
{


    public function login(AuthLoginRequest $request)
    {
        $data = $request->validated();

        if (!$token = Auth::guard('api')->attempt($data)) {
            return sendError(401,'Unauthorized');
        }

        return $this->respondWithToken($token); # If all credentials are correct - we are going to generate a new access token and send it back on response
    }


    public function me()
    {
        return response()->json(auth()->user());
    }


    public function logout()
    {
        auth()->logout(); # This is just logout function that will destroy access token of current user

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        # When access token will be expired, we are going to generate a new one wit this function
        # and return it here in response
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        # This function is used to make JSON response with new
        # access token of current user
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }






}
