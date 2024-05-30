<?php

namespace App\Providers;

use App\Contracts\CategoryServiceContract;
use App\Contracts\NewsServiceContract;
use App\Contracts\PostServiceContract;
use App\Services\CategoryService;
use App\Services\CategoryServiceWorkApi;
use App\Services\NewsService;
use App\Services\PostLocalService;
use App\Services\PostService;
use App\Services\PostServiceWorkApi;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class ServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PostServiceContract::class, PostServiceWorkApi::class);
        // $this->app->bind(PostServiceContract::class, PostService::class);
        $this->app->bind(CategoryServiceContract::class, CategoryServiceWorkApi::class);
        // $this->app->bind(CategoryServiceContract::class, CategoryService::class);
        $this->app->bind(NewsServiceContract::class, NewsService::class);


        // $appEnv = config('app.env');
        // if($appEnv == 'local'){
        //     $this->app->bind(PostServiceContract::class, PostService::class);
        //     $this->app->bind(CategoryServiceContract::class, CategoryService::class);
        // }elseif($appEnv == 'production'){
        //     $this->app->bind(PostServiceContract::class, PostServiceWorkApi::class);
        //     $this->app->bind(CategoryServiceContract::class, CategoryServiceWorkApi::class);
        // }
        //----------------------------------------------------------------
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

        //yoki
        // use Illuminate\Support\Facades\Config;
        // $perPage = Config::get('settings.per_page'); /// 'paginatoin_per_page' => env('PAGINATION_PER_PAGE', 10),
        // Config::set('settings.per_page', 20);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
