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
        // $appEnv = config('app.env');
        // if($appEnv == 'local'){
        //     $this->app->bind(PostServiceContract::class, PostLocalService::class);
        // }elseif($appEnv == 'production'){
        //     $this->app->bind(PostServiceContract::class, PostService::class);
        // }
        $this->app->bind(PostServiceContract::class, PostService::class);
        // $this->app->bind(PostServiceContract::class, PostLocalService::class);




        /***
        Do not get data from the .env file directly
        Pass the data to config files instead and then use the config() helper function to use the data in an application.
        ***/
        // Bad:
        // $apiKey = env('API_KEY');
        //Good:
        // Use the data
        // $apiKey = config('api.key'); ///config/api.php ///'key' => env('API_KEY'),
        // $appEnv = config('app.env'); ///config/api.php ///'key' => env('API_KEY'),
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
