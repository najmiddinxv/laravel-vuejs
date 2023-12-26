<?php

use App\Http\Controllers\Frontend\UserProfile\AuthProfileController;
use App\Http\Controllers\Frontend\UserProfile\UserProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localize','localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function (){
    Route::group(['prefix' => 'profile', 'as'=>'userProfile.','name' => 'userProfile.'], function (){
        // Route::group(['prefix' => 'profile', 'as'=>'profile.','name' => 'profile.', 'middleware' => ['auth']], function (){
            Route::controller(AuthProfileController::class)->name('auth.')->group(function() {
            Route::get('register', 'showRegisterForm')->name('showRegisterForm')->middleware('guest');
            Route::post('register', 'register')->name('register')->middleware('guest');
            Route::get('login', 'showLoginForm')->name('showLoginForm')->middleware('guest');
            Route::post('login', 'login')->name('login')->middleware('guest');
            Route::post('logout', 'logout')->name('logout')->middleware('auth');
        });
        Route::controller(UserProfileController::class)->group(function() {
            Route::get('/', 'index')->name('index');
        });

    });
});
