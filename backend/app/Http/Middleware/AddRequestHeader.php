<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class AddRequestHeader
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (!$request->hasHeader('accept')) {
            $request->headers->set('Accept', 'application/json');
        }

        $locale = config('app.locale');
        if ($request->hasHeader('accept-language') && in_array($request->header('accept-language'), config('app.locales', []), true)) {
            $locale = $request->header('accept-language');
        }
        app()->setLocale($locale);
        Carbon::setLocale($locale == 'uz' ? 'uz_Latn' : $locale);

        return $next($request);
    }
}
