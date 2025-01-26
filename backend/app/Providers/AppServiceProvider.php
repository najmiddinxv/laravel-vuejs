<?php

namespace App\Providers;

use App\Macros\StringMacros;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Services\MyCustomService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('myCustomService', function ($app) { //yangiMyCustomService fasadi uchun bu
            return new MyCustomService();
        });    
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        // JsonResource::withoutWrapping();
        // Model::preventLazyLoading(app()->isLocal());
    }
}
