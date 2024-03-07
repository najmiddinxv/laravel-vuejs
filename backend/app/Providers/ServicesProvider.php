<?php

namespace App\Providers;

use App\Services\Contracts\PostServiceContract;
use App\Services\Contracts\UserServiceContract;
use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class ServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PostServiceContract::class, PostService::class);
        $this->app->bind(UserServiceContract::class, UserService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
