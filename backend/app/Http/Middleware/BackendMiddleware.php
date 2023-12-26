<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class BackendMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()){
            if (auth()->user()->status === User::STATUS_BACKEND) {
                return $next($request);
            }else{
                Session::flush();
                Auth::logout();
                return redirect()->route('frontend.index')->with('error','Invalid login credentials.');
            }
        }else{
            return redirect()->route('backend.auth.login')->with('error','Invalid login credentials.');
        }
        return redirect()->route('frontend.index')->with('error','Invalid login credentials.');
    }
}
