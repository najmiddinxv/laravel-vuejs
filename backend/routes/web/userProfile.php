<?php

use App\Http\Controllers\Frontend\UserProfile\AuthProfileController;
use App\Http\Controllers\Frontend\UserProfile\UserProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localize','localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function (){
    Route::group(['prefix' => 'profile', 'as'=>'userProfile.','name' => 'userProfile.'], function (){
        Route::controller(AuthProfileController::class)->name('auth.')->group(function() {
            Route::get('register', 'showRegisterForm')->name('showRegisterForm');
            Route::post('register', 'register')->name('register');
            Route::get('login', 'showLoginForm')->name('showLoginForm');
            Route::post('login', 'login')->name('login');
            Route::post('logout', 'logout')->name('logout')->middleware('auth');
        });
        Route::middleware('auth')->group(function() {
            Route::controller(UserProfileController::class)->group(function() {
                Route::get('/', 'index')->name('index');
            });
        });

    });
});
