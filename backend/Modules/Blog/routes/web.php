<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Blog\app\Http\Controllers\BlogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localize','localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function (){
    Route::group(['as'=>'module.', 'name'=>'module.'], function () {
        Route::resource('blog', BlogController::class);
    });
});

