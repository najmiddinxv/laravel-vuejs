<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CacheTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        // Attempt to retrieve user from cache
        $cacheKey = 'auth_token_' . $token;
        $user = Cache::get($cacheKey);

        if (!$user) {
            // If user is not in cache, query the database
            $tokenData = DB::table('personal_access_tokens')
                ->where('token', hash('sha256', $token))
                ->where('expires_at', '>', now())
                ->first();

            if (!$tokenData) {
                return response()->json(['error' => 'Invalid token'], 401);
            }

            $user = DB::table('users')->find($tokenData->tokenable_id);

            // Cache the user information
            Cache::put($cacheKey, $user, now()->addMinutes(config('sanctum.expiration')));
        }

        // Authenticate the user
        Auth::setUser($user);

        return $next($request);
    }
}
