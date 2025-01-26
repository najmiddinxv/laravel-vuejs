<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\User\PersonalAccessToken;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class AuthApiSanctumController extends BaseApiController
{
    //===================================================================================
    //auth va refresh tokenni bitta qatorga saqlash uchun yozilgan kodning optimal varianti
    //===================================================================================
    private const ACCESS_TOKEN_EXPIRATION_MINUTES = 1440; // 24 hours * 60 minutes
    private const REFRESH_TOKEN_EXPIRATION_DAYS = 7;
    private const AUTH_TOKEN_NAME = 'authToken';
    private const REFRESH_TOKEN_NAME = 'refreshToken';

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user->tokens()->where('expires_at_refresh_token', '<', Carbon::now())->delete();

        $accessToken = $user->createToken(
            self::AUTH_TOKEN_NAME,
            ['*'],
            Carbon::now()->addMinutes(self::ACCESS_TOKEN_EXPIRATION_MINUTES)
        )->plainTextToken;

        $userDeviceName = $request->header('User-Agent');
        $userIp = $request->ip();
        $userLocation = $this->getUserLocation($userIp);
        $refreshToken = Str::random(64);

        $tokenId = explode('|', $accessToken)[0];
        $accessTokenUpdate = PersonalAccessToken::find($tokenId);
        $accessTokenUpdate->update([
            'user_device_name' => $userDeviceName,
            'user_ip' => $userIp,
            'user_location_info' => $userLocation,
            'refresh_token' => hash('sha256', $refreshToken),
            'expires_at_refresh_token' => Carbon::now()->addDays(self::REFRESH_TOKEN_EXPIRATION_DAYS),
        ]);

        return sendResponse(
            message: 'Successfully logged in',
            data: [
                'token' => $accessToken,
                'refresh_token' => $refreshToken,
            ]
        );
    }

    public function refresh(Request $request)
    {
        $request->validate([
            'refresh_token' => 'required|string',
        ]);

        $hashedToken = hash('sha256', $request->refresh_token);
        $refreshToken = PersonalAccessToken::where('refresh_token', $hashedToken)
                                           ->where('expires_at', '>', Carbon::now())
                                           ->first();

        if (!$refreshToken) {
            return response()->json(['message' => 'Invalid or expired refresh token'], 401);
        }

        $user = $refreshToken->user;
        $refreshToken->delete();

        $newAccessToken = $user->createToken(
            self::AUTH_TOKEN_NAME,
            ['*'],
            Carbon::now()->addMinutes(self::ACCESS_TOKEN_EXPIRATION_MINUTES)
        )->plainTextToken;

        $userDeviceName = $request->header('User-Agent');
        $userIp = $request->ip();
        $userLocation = $this->getUserLocation($userIp);
        $newRefreshToken = Str::random(64);
        $tokenId = explode('|', $newAccessToken)[0];

        PersonalAccessToken::find($tokenId)->update([
            'user_device_name' => $userDeviceName,
            'user_ip' => $userIp,
            'user_location_info' => $userLocation,
            'refresh_token' => hash('sha256', $newRefreshToken),
            'expires_at_refresh_token' => Carbon::now()->addDays(self::REFRESH_TOKEN_EXPIRATION_DAYS),
        ]);

        $user->tokens()->where('expires_at_refresh_token', '<', Carbon::now())->delete();

        return response()->json([
            'access_token' => $newAccessToken,
            'refresh_token' => $newRefreshToken,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function logoutFromAllDevices(Request $request)
    {
        $user = $request->user();
        $user->tokens()
            ->where('id', '!=', $user->currentAccessToken()->id)
            ->delete();

        return response()->json(['message' => 'Logged out from other devices']);
    }

    private function getUserLocation($ip)
    {
        $response = Http::get("https://ipinfo.io/{$ip}/json");
        return $response->json() ?? ['error' => 'API not working'];
    }
    //==========================================================================================
    //==========================================================================================

    //===================================================================================
    //auth va refresh tokenni bitta qatorga saqlash uchun yozilgan kod
    //===================================================================================
    // private const ACCESS_TOKEN_EXPIRATION_MINUTES = 24*60;
    // private const REFRESH_TOKEN_EXPIRATION_DAYS = 7;
    // private const AUTH_TOKEN_NAME = 'authToken';
    // private const REFRESH_TOKEN_NAME = 'refreshToken';

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|string|min:6',
    //     ]);

    //     $user = User::where('email', $request->email)->first();

    //     if (!$user || !Hash::check($request->password, $user->password)) {
    //         return response()->json(['message' => 'Unauthorized'], 401);
    //     }

    //     $user->tokens()->where('expires_at_refresh_token', '<', Carbon::now())->delete();

    //     $accessToken = $user->createToken(
    //         self::AUTH_TOKEN_NAME, ['*'],
    //         Carbon::now()->addMinutes(self::ACCESS_TOKEN_EXPIRATION_MINUTES)
    //     )->plainTextToken;

    //     $userDeviceName = $request->header('User-Agent');
    //     $userIp = $request->ip();
    //     $userLocation = Http::get("https://ipinfo.io/{$userIp}/json")->json() ?? ['error' => 'api not working'];
    //     $refreshToken = Str::random(64);

    //     $tokenId = explode('|', $accessToken)[0];
    //     $accessTokenUpdate = PersonalAccessToken::find($tokenId);
    //     $accessTokenUpdate->update([
    //         'user_device_name' => $userDeviceName,
    //         'user_ip' => $userIp,
    //         'user_location_info' => $userLocation,
    //         'refresh_token' =>  hash('sha256', $refreshToken),
    //         'expires_at_refresh_token' => Carbon::now()->addDays(self::REFRESH_TOKEN_EXPIRATION_DAYS),
    //     ]);

    //     $responseData = [
    //         'token' => $accessToken,
    //         'refresh_token' => $refreshToken,
    //     ];
    //     return sendResponse(message:'Successfully logged in', data: $responseData);
    // }

    // public function refresh(Request $request)
    // {
    //     $request->validate([
    //         'refresh_token' => 'required|string',
    //     ]);

    //     $hashedToken = hash('sha256', $request->refresh_token);
    //     $refreshToken = PersonalAccessToken::where('refresh_token', $hashedToken)
    //                                         ->where('expires_at', '>', Carbon::now())
    //                                         ->first();

    //     if (!$refreshToken) {
    //         return response()->json(['message' => 'Invalid or expired refresh token'], 401);
    //     }

    //     $user = $refreshToken->user;

    //     $refreshToken->delete();

    //     // Create access token with short expiration
    //     $newAccessToken = $user->createToken(
    //         self::AUTH_TOKEN_NAME, ['*'],
    //         Carbon::now()->addMinutes(self::ACCESS_TOKEN_EXPIRATION_MINUTES)
    //     )->plainTextToken;

    //     $userDeviceName = $request->header('User-Agent');
    //     $userIp = $request->ip();
    //     $userLocation = Http::get("https://ipinfo.io/{$userIp}/json")->json();
    //     $newRefreshToken = Str::random(64);
    //     $tokenId = explode('|', $newAccessToken)[0];

    //     $user->tokens()->where('id', $tokenId)
    //     ->update([
    //         'user_device_name' => $userDeviceName,
    //         'user_ip' => $userIp,
    //         'user_location_info' => $userLocation,
    //         'refresh_token' => hash('sha256', $newRefreshToken),
    //         'expires_at_refresh_token' => Carbon::now()->addDays(self::REFRESH_TOKEN_EXPIRATION_DAYS),
    //     ]);

    //     $user->tokens()->where('expires_at_refresh_token', '<', Carbon::now())->delete();

    //     return response()->json([
    //         'access_token' => $newAccessToken,
    //         'refresh_token' => $newRefreshToken,
    //     ]);
    // }

    // public function logout(Request $request)
    // {
    //     $request->user()->currentAccessToken()->delete();
    //     return response()->json(['message' => 'Successfully logged out']);
    // }

    // //ushbu qurilmadan boshqa barcha qurilmalarni chiqarib yuborish
    // public function logoutFromAllDevices(Request $request)
    // {
    //     $user = $request->user();
    //     $user->tokens()
    //         ->where('id', '!=', $request->user()->currentAccessToken()->id)
    //         ->delete();

    //     // // delete all tokens, essentially logging the user out
    //     // $user->tokens()->delete();
    //     // // Revoke a specific token...
    //     // $user->tokens()->where('id', $tokenId)->delete();

    //     return response()->json(['message' => 'Logged out from other devices']);
    // }

    //===================================================================================
    //===================================================================================
}
