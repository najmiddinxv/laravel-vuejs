<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Macros\ColumnSearchMacros;
use App\Macros\HelperMethodsMacros;
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
        SortByMacros::sortBy();
        SortByMacros::sortByJson();
        HelperMethodsMacros::sendResponse();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
