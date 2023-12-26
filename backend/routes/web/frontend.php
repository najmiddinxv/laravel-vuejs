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

    // Route::controller(PostController::class)->prefix('post')->name('frontend.post.')->group(function() {
    //     Route::get('/', 'index')->name('index');
    // });

    // Route::group(['middleware' => ['can:publish articles']], function () {
    //     //
    // });
    // Route::group(['middleware' => ['role:manager']], function () {
    //     //
    // });

    // // for a specific guard:
    // Route::group(['middleware' => ['role:manager,api']], function () {
    //     //
    // });

    // Route::group(['middleware' => ['permission:publish articles']], function () {
    //     //
    // });

    // Route::group(['middleware' => ['role:manager','permission:publish articles']], function () {
    //     //
    // });

    // Route::group(['middleware' => ['role_or_permission:publish articles']], function () {
    //     //
    // });


    // Route::group(['middleware' => ['role:manager|writer']], function () {
    //     //
    // });

    // Route::group(['middleware' => ['permission:publish articles|edit articles']], function () {
    //     //
    // });

    // // for a specific guard
    // Route::group(['middleware' => ['permission:publish articles|edit articles,api']], function () {
    //     //
    // });

    // Route::group(['middleware' => ['role_or_permission:manager|edit articles']], function () {
    //     //
    // });

    // public function __construct()
    // {
    //     $this->middleware(['role:manager','permission:publish articles|edit articles']);
    // }

    // public function __construct()
    // {
    //     $this->middleware(['role_or_permission:manager|edit articles']);
    // }

});
