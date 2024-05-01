<?php

use App\Http\Controllers\Backend\AuthBackendController;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ImageController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\TinymceFileController;
use App\Http\Controllers\Backend\UserConroller;
use App\Http\Controllers\Backend\WordController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localize','localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function (){

    Route::prefix('admin')->controller(AuthBackendController::class)->as('backend.')->name('backend.auth.')->group(function() {
        Route::get('register', 'showRegisterForm')->name('showRegisterForm')->middleware('guest');
        Route::post('register', 'register')->name('register')->middleware('guest');
        Route::get('login', 'showLoginForm')->name('showLoginForm')->middleware('guest');
        Route::post('login', 'login')->name('login')->middleware('guest');
        Route::post('logout', 'logout')->name('logout')->middleware(['backend']);
    });
    Route::group(['prefix' => 'admin', 'as'=>'backend.', 'middleware' => ['backend','role:admin|manager']], function (){
        Route::controller(BackendController::class)->group(function() {
            Route::get('/', 'index')->name('index');
        });
        // Route::resource('users',UserConroller::class,[]);
        Route::prefix('users')->controller(UserConroller::class)->name('users.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('create','create')->name('create');
            Route::post('store','store')->name('store');
            Route::get('edit/{user}','edit')->name('edit');
            Route::put('update/{id}','update')->name('update');
            Route::get('show/{user}','show')->name('show');
            Route::delete('destroy/{id}','destroy')->name('destroy');
        });
        Route::prefix('roles')->name('roles.')->controller(RoleController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::put('update/{id}', 'update')->name('update');
            Route::delete('destroy/{id}', 'destroy')->name('destroy');
        });
        Route::prefix('permissions')->name('permissions.')->controller(PermissionController::class)->group(function () {
           Route::get('/', 'index')->name('index');
           Route::post('store','store')->name('store');
           Route::get('edit/{id}','edit')->name('edit');
           Route::put('update/{id}','update')->name('update');
           Route::delete('destroy/{id}','destroy')->name('destroy');
        });
        //content
        Route::prefix('tags')->name('tags.')->controller(TagController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('store','store')->name('store');
            Route::get('edit/{tag}','edit')->name('edit');
            Route::put('update/{tag}','update')->name('update');
            Route::delete('destroy/{tag}','destroy')->name('destroy');
        });
        Route::prefix('words')->name('words.')->controller(WordController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('store','store')->name('store');
            Route::get('edit/{word}','edit')->name('edit');
            Route::put('update/{word}','update')->name('update');
            Route::delete('destroy/{word}','destroy')->name('destroy');
        });
        Route::prefix('categories')->name('categories.')->controller(CategoryController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            // Route::get('show', 'show')->name('show');
            Route::get('create', 'create')->name('create');
            Route::post('store','store')->name('store');
            Route::get('edit/{category}','edit')->name('edit');
            Route::put('update/{category}','update')->name('update');
            Route::delete('destroy/{category}','destroy')->name('destroy');
        });
        Route::prefix('menu')->name('menu.')->controller(MenuController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store','store')->name('store');
            Route::get('edit/{menu}','edit')->name('edit');
            Route::put('update/{menu}','update')->name('update');
            Route::delete('destroy/{menu}','destroy')->name('destroy');
        });
        Route::prefix('files')->name('tinymceFiles.')->controller(TinymceFileController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store','store')->name('store');
            Route::get('edit/{tinymceFile}','edit')->name('edit');
            Route::put('update/{tinymceFile}','update')->name('update');
            Route::delete('destroy/{tinymceFile}','destroy')->name('destroy');
        });
        Route::prefix('images')->name('images.')->controller(ImageController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store','store')->name('store');
            Route::get('edit/{id}','edit')->name('edit');
            Route::put('update/{id}','update')->name('update');
            Route::delete('destroy/{image}','destroy')->name('destroy');
        });
        Route::prefix('posts')->name('posts.')->controller(PostController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('show/{post}', 'show')->name('show');
            Route::get('create', 'create')->name('create');
            Route::post('store','store')->name('store');
            Route::get('edit/{post}','edit')->name('edit');
            Route::put('update/{post}','update')->name('update');
            Route::delete('destroy/{post}','destroy')->name('destroy');
        });
        Route::prefix('pages')->name('pages.')->controller(PageController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('show/{page}', 'show')->name('show');
            Route::get('create', 'create')->name('create');
            Route::post('store','store')->name('store');
            Route::get('edit/{page}','edit')->name('edit');
            Route::put('update/{page}','update')->name('update');
            Route::delete('destroy/{page}','destroy')->name('destroy');
        });

    });


});

// Route::get('post/{post_id}', 'PostController@show')->name('posts.show');
