<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthApiJwtController extends BaseApiController
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $refreshToken = JWTAuth::fromUser(Auth::user());

        return response()->json([
            'access_token' => $token,
            'refresh_token' => $refreshToken,
        ]);
    }

    public function refresh()
    {
        $newToken = JWTAuth::parseToken()->refresh();

        return response()->json([
            'access_token' => $newToken,
        ]);
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Successfully logged out']);
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

        Route::post('login', [AuthController::class, 'login']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('logout', [AuthController::class, 'logout'])->middleware('auth.jwt');
     *   **/




    //  AuthApiController.php

    // public function login(AuthLoginRequest $request)
    // {
    //     $data = $request->validated();
    //     if (!$token = auth('api')->attempt($data)) {
    //         return sendError(401,'Unauthorized');
    //     }
    //     return sendResponse(message:'the user is logged in ',data:$this->respondWithToken($token)); # If all credentials are correct - we are going to generate a new access token and send it back on response
    // }

    // public function me()
    // {
    //     return response()->json(auth('api')->user());
    // }

    // public function logout()
    // {
    //     auth('api')->logout(); # This is just logout function that will destroy access token of current user
    //     return response()->json(['message' => 'Successfully logged out']);
    // }

    // public function refresh()
    // {
    //     # When access token will be expired, we are going to generate a new one wit this function
    //     # and return it here in response
    //     // $newToken = JWTAuth::parseToken()->refresh();
    //     return $this->respondWithToken(auth('api')->refresh());
    // }

    // protected function respondWithToken($token)
    // {
    //     # This function is used to make JSON response with new
    //     # access token of current user
    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         'expires_in' => auth('api')->factory()->getTTL() * 60,
    //         'user' => $this->me(),
    //     ]);
    // }

}
