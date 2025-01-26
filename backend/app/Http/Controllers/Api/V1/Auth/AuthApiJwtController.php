<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\V1\AuthLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthApiJwtController extends BaseApiController
{

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return sendError(422,$validator->errors()); redirect()->back()->with('error', $validator->errors())->withInput();
        }

        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (!$token = auth('api')->attempt($data)) {
            return sendError(401,'Unauthorized');
        }

        return sendResponse(message:'the user is logged in ',data:$this->respondWithToken($token)); # If all credentials are correct - we are going to generate a new access token and send it back on response
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }

    public function logout()
    {
        auth('api')->logout(); # This is just logout function that will destroy access token of current user
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        # When access token will be expired, we are going to generate a new one wit this function
        # and return it here in response
        // $newToken = JWTAuth::parseToken()->refresh();
        return $this->respondWithToken(auth('api')->refresh());
    }

    protected function respondWithToken($token)
    {
        # This function is used to make JSON response with new
        # access token of current user
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => $this->me(),
        ]);
    }

    
    /**
        composer require tymon/jwt-auth
        php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
        php artisan jwt:secret
     *
     *
     *
        protected $routeMiddleware = [
            // ...
            'auth.jwt' => \Tymon\JWTAuth\Http\Middleware\Authenticate::class,
        ];

        'guards' => [
            'api' => [
                'driver' => 'jwt',
                'provider' => 'users',
            ],
        ],

        Route::post('login', [AuthApiJwtController::class, 'login'])->name('api.auth.login');
        Route::post('refresh', [AuthApiJwtController::class, 'refresh'])->name('api.auth.refresh');
        Route::post('logout', [AuthApiJwtController::class, 'logout'])->name('api.auth.logout')->middleware('api');
        Route::get('me', [AuthApiJwtController::class, 'logout'])->name('api.auth.logout')->middleware('api');
     *   **/

}
