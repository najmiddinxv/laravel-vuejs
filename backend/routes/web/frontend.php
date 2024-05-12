<?php

use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\PostController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => ['localize','localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function (){
    Route::group(['as'=>'frontend.', 'name' => 'frontend.'], function (){
        Route::controller(FrontendController::class)->group(function() {
            Route::get('/', 'index')->name('index');
        });
        Route::prefix('posts')->name('posts.')->controller(PostController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('{slug}', 'show')->name('show');
            Route::get('by-tag/{tagId}', 'byTag')->name('byTag');
        });
        Route::prefix('comments')->name('comments.')->controller(CommentController::class)->group(function () {
            Route::post('store/{commentableId}/{commentableType}', 'store')->name('store');
            Route::post('store-reply/{commentId}', 'storeReply')->name('storeReply');
        });
    });
});
