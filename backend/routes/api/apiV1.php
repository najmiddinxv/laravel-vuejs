<?php

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Api\V1\{
    AuthApiController,
    AuthApiSanctumController,
    CategoryController,
    PostController,
    TagController,
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//=============================sanctum uchun===========================
// {{localhost}}/api/v1/login
// Route::post('register', [AuthApiSanctumController::class, 'register'])->name('api.auth.register');
Route::post('login', [AuthApiSanctumController::class, 'login'])->name('api.auth.login');
Route::post('refresh', [AuthApiSanctumController::class, 'refresh'])->name('api.auth.refresh');
Route::post('logout', [AuthApiSanctumController::class, 'logout'])->name('api.auth.logout')->middleware('auth:sanctum');
Route::post('logout-from-all-devices', [AuthApiSanctumController::class,'logoutFromAllDevices'])->name('api.auth.logoutFromAllDevices')->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});







Route::as('api')->name('api.')->middleware(['addRequestHeader'])->group(function () {

    Route::controller(BaseApiController::class)->group(function () {
        Route::get('/', 'baseApiIndex')->name('baseApiIndex')->middleware('role:admin|manager'); //spatie permission ishlayapti
    });

    Route::apiResources([
        'posts' => PostController::class,
        'categories' => CategoryController::class,
        'tags' => TagController::class,
    ]);

});



