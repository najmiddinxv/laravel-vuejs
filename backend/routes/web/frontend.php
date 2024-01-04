<?php

use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => ['localize','localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function (){
    Route::group(['as'=>'frontend.', 'name' => 'frontend.'], function (){
        Route::controller(FrontendController::class)->group(function() {
            Route::get('/', 'index')->name('index');
        });

    });


});
