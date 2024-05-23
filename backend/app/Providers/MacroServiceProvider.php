<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use App\Macros\BuilderMacros;
class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        BuilderMacros::whenNameLike();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
