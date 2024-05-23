<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Macros\ColumnSearchMacros;
use App\Macros\SortByMacros;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        ColumnSearchMacros::whenJsonColumnLike();
        ColumnSearchMacros::whenJsonColumnLikeForEachWord();
        SortByMacros::example();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
