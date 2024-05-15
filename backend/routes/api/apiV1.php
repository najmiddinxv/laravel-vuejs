<?php

use App\Http\Controllers\Api\V1\AuthApiController;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;


Route::as('api')->name('api.')->middleware('addRequestHeader')->group(function () {
    Route::controller(AuthApiController::class)->group(function () {
        Route::post('register', 'register')->name('register');
        Route::post('login', 'login')->name('login');
        Route::post('logout', 'logout')->name('logout')->middleware('auth:sanctum');
        Route::post('logout-all', 'logout_all_devices')->name('logout-all')->middleware('auth:sanctum');
    });

    Route::controller(BaseApiController::class)->group(function () {
        Route::get('/', 'index')->name('index');
    });

    Route::apiResources([
        'users' => UserController::class,
        'posts' => PostController::class,
    ]);

});
