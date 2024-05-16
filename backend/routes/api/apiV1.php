<?php

use App\Http\Controllers\Api\V1\AuthApiController;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;


Route::post('register', [AuthApiController::class, 'register'])->name('api.auth.register');
Route::post('login', [AuthApiController::class, 'login'])->name('api.auth.login');
Route::get('test',function (){
    return 'hello';
});

Route::as('api')->name('api.')->middleware(['addRequestHeader','auth:api'])->group(function () {
    Route::controller(AuthApiController::class)->group(function () {
        Route::post('logout', 'logout')->name('auth.logout');
        Route::post('logout-all', 'logout_all_devices')->name('auth.logout-all');
        Route::post('refresh', 'refresh')->name('auth.refresh');
        Route::post('me', 'me')->name('auth.me');
    });
    Route::controller(BaseApiController::class)->group(function () {
        Route::get('/', 'baseApiIndex')->name('baseApiIndex')->middleware('role:admin|manager'); //spatie permission ishlayapti
    });

    Route::apiResources([
        'users' => UserController::class,
        'posts' => PostController::class,
    ]);



});



