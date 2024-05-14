<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    use \Mcamara\LaravelLocalization\Traits\LoadsTranslatedCachedRoutes;
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    protected string $ApiNamespace = 'App\Http\Controllers\Api';
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->middleware('addRequestHeader')
                ->group(base_path('routes/api/api.php'));

            Route::prefix('api/v2')
                ->middleware('api')
                ->namespace($this->ApiNamespace.'\\V2')
                ->group(base_path('routes/API/v2.php'));
                

            Route::middleware('web')
                ->group(base_path('routes/web/backend.php'))
                ->group(base_path('routes/web/frontend.php'))
                ->group(base_path('routes/web/userProfile.php'));
        });
    }
}
