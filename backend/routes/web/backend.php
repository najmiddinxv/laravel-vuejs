<?php

use App\Http\Controllers\Backend\AuthBackendController;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\TagController;
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

    });




//    Route::group(['prefix'=>'role'],function(){
//        Route::get('/index',[RoleController::class, 'index'])->name('role.index');
//        Route::get('/create',[RoleController::class, 'create'])->name('role.create');
//        Route::post('/store',[RoleController::class, 'store'])->name('role.store');
//        Route::get('/edit/{id}',[RoleController::class, 'edit'])->name('role.edit');
//        Route::put('/update/{id}',[RoleController::class, 'update'])->name('role.update');
//        // Route::get('/show/{id}',[RoleController::class, 'show'])->name('role.show');
//        Route::delete('/destroy/{id}',[RoleController::class, 'destroy'])->name('role.destroy');
//    });
//    Route::group(['prefix'=>'permission'],function(){
//        Route::get('/index',[PermissionController::class, 'index'])->name('permission.index');
//        Route::get('/create',[PermissionController::class, 'create'])->name('permission.create');
//        Route::post('/store',[PermissionController::class, 'store'])->name('permission.store');
//        Route::get('/edit/{id}',[PermissionController::class, 'edit'])->name('permission.edit');
//        Route::put('/update/{id}',[PermissionController::class, 'update'])->name('permission.update');
//        // Route::get('/show/{id}',[PermissionController::class, 'show'])->name('permission.show');
//        Route::delete('/destroy/{id}',[PermissionController::class, 'destroy'])->name('permission.destroy');
//    });
//    Route::group(['prefix'=>'role-has-permissions'],function(){
//        Route::get('/index',[RoleHasPermissonController::class, 'index'])->name('role-has-permissions.index');
//        Route::get('/create',[RoleHasPermissonController::class, 'create'])->name('role-has-permissions.create');
//        Route::post('/store',[RoleHasPermissonController::class, 'store'])->name('role-has-permissions.store');
//        Route::get('/edit/permissionId/{permission_id}/roleId/{role_id}',[RoleHasPermissonController::class, 'edit'])->name('role-has-permissions.edit');
//        Route::put('/update/permissionId/{permission_id}/roleId/{role_id}',[RoleHasPermissonController::class, 'update'])->name('role-has-permissions.update');
//        // Route::get('/show/permissionId/{permission_id}/roleId/{role_id}',[RoleHasPermissonController::class, 'show'])->name('role-has-permissions.show');
//        Route::delete('/destroy/permissionId/{permission_id}/roleId/{role_id}',[RoleHasPermissonController::class, 'destroy'])->name('role-has-permissions.destroy');
//    });

    // Route::group(['prefix'=>'model-has-role'],function(){
    // Route::get('/index',[ModelHasRoleController::class, 'index'])->name('model-has-role.index');
    // Route::get('/create',[ModelHasRoleController::class, 'create'])->name('model-has-role.create');
    // Route::post('/store',[ModelHasRoleController::class, 'store'])->name('model-has-role.store');
    // Route::get('/edit/{role_id}/model/{model_id}',[ModelHasRoleController::class, 'edit'])->name('model-has-role.edit');
    // Route::put('/update/role/{role_id}/model/{model_id}',[ModelHasRoleController::class, 'update'])->name('model-has-role.update');
    // Route::get('/show/{id}',[ModelHasRoleController::class, 'show'])->name('model-has-role.show');
    // Route::delete('/destroy/role/{role_id}/model/{model_id}',[ModelHasRoleController::class, 'destroy'])->name('model-has-role.destroy');
    // });

    // Route::group(['prefix'=>'model-has-permission'],function(){
    // Route::get('/index',[ModelHasPermissionController::class, 'index'])->name('model-has-permission.index');
    // Route::get('/create',[ModelHasPermissionController::class, 'create'])->name('model-has-permission.create');
    // Route::post('/store',[ModelHasPermissionController::class, 'store'])->name('model-has-permission.store');
    // Route::get('/edit/permission/{permission_id}/model/{model_id}',[ModelHasPermissionController::class, 'edit'])->name('model-has-permission.edit');
    // Route::put('/update/permission/{permission_id}/model/{model_id}',[ModelHasPermissionController::class, 'update'])->name('model-has-permission.update');
    // Route::get('/show/{id}',[ModelHasPermissionController::class, 'show'])->name('model-has-permission.show');
    // Route::delete('/destroy/permission/{permission_id}/model/{model_id}',[ModelHasPermissionController::class, 'destroy'])->name('model-has-permission.destroy');
    // });



    // Route::group(['middleware' => ['can:publish articles']], function () {
    //     //
    // });

    // for a specific guard: -> yani web uchun yoki api uchun maxus // api chiqaradigan route uchun api, browserdagi web uchun web
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
