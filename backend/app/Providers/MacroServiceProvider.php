<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Macros\ColumnSearchMacros;
use App\Macros\HelperMethodsMacros;
use App\Macros\SortByMacros;

class MacroServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        ColumnSearchMacros::whenJsonColumnLike();
        ColumnSearchMacros::whenJsonColumnLikeForEachWord();
        SortByMacros::sortBy();
        SortByMacros::sortByJson();
        HelperMethodsMacros::sendResponse();
        HelperMethodsMacros::sendError();
    }

    public function boot(): void
    {
        //
    }
}
