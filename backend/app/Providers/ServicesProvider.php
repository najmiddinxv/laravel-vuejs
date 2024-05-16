<?php

namespace App\Providers;

use App\Contracts\PostServiceContract;
use App\Services\PostLocalService;
use App\Services\PostService;
use Illuminate\Support\ServiceProvider;

class ServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PostServiceContract::class, PostService::class);
        // $this->app->bind(PostServiceContract::class, PostLocalService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
