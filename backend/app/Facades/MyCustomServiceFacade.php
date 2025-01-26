<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class MyServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'myCustomService';  // This should match the service container binding
    }
}
