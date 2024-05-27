<?php

namespace App\Http\Controllers\Api\V1;

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
{   public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

          // Get user's device name (if available)
        $userDeviceName = $request->header('User-Agent');

        // Get user's IP address
        $userIp = $request->ip();

        // Get user's location (if available)
        $userLocation = $this->getUserLocation($userIp);

        // Create access token with short expiration
        $accessToken = $user->createToken(
            'authToken', ['*'],
            Carbon::now()->addMinutes(config('sanctum.expiration'))
        )->plainTextToken;

        $tokenId = explode('|', $accessToken)[0];

        $user->tokens()->where('id', $tokenId)
        ->update([
            'user_device_number' => $tokenId,
            'user_device_name' => $userDeviceName,
            'user_ip' => $userIp,
            'user_location_info' => $userLocation,
        ]);

        // Create refresh token with long expiration
        $refreshToken = Str::random(64);
        $refreshTokenModel = $user->tokens()->create([
            'name' => 'refreshToken',
            'token' => hash('sha256', $refreshToken),
            'abilities' => ['*'],
            'expires_at' => Carbon::now()->addDays(7),
        ]);

        // Update the user_device field for the refresh token
        $refreshTokenModel->forceFill([
            'user_device_number' => $tokenId,
            'user_device_name' => $userDeviceName,
            'user_ip' => $userIp,
            'user_location_info' => $userLocation,
        ])->save();

        $user->tokens()
            ->where('expires_at', '<', Carbon::now())
            ->delete();

        return response()->json([
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
        ]);
    }

    private function getUserLocation($ip)
    {
        // Make an HTTP request to an IP geolocation service (here, we use ipinfo.io)
        $response = Http::get("https://ipinfo.io/{$ip}/json");
        return  $response->json();
    }

    public function refresh(Request $request)
    {
        $request->validate([
            'refresh_token' => 'required',
        ]);

        $hashedToken = hash('sha256', $request->refresh_token);
        $refreshToken = PersonalAccessToken::where('token', $hashedToken)
                                            ->where('name', 'refreshToken')
                                            ->where('expires_at', '>', Carbon::now())
                                            ->first();

        if (!$refreshToken) {
            return response()->json(['message' => 'Invalid or expired refresh token'], 401);
        }

        $user = $refreshToken->user;

        // Revoke old refresh token
        $refreshToken->delete();
        $user->tokens()
            ->where('user_device_number', '=', $refreshToken->user_device_number)
            ->where('name', 'authToken')
            ->delete();

        // Create new access token
        $newAccessToken = $user->createToken('authToken', ['*'], Carbon::now()->addMinutes(config('sanctum.expiration')))->plainTextToken;

        // Create new refresh token
        $newRefreshToken = Str::random(64);
        $user->tokens()->create([
            'name' => 'refreshToken',
            'token' => hash('sha256', $newRefreshToken),
            'abilities' => ['*'],
            'expires_at' => Carbon::now()->addDays(7),
        ]);

        return response()->json([
            'access_token' => $newAccessToken,
            'refresh_token' => $newRefreshToken,
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }

    //ushbu qurilmadan boshqa barcha qurilmalarni chiqarib yuborish
    public function logoutFromAllDevices(Request $request)
    {

        $user = $request->user();
        $currentAccessTokenId = $user->currentAccessToken();
        $user->tokens()->where('user_device_number', '!=', $currentAccessTokenId->user_device_number)->delete();

        return response()->json(['message' => 'Logged out from other devices']);
    }





}
