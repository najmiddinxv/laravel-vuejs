<?php

namespace App\Providers;

use App\Macros\StringMacros;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        StringMacros::register();
//        Model::preventLazyLoading(app()->isLocal());
    }
}
