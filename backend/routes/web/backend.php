<?php

use App\Http\Controllers\Backend\AuthBackendController;
use App\Http\Controllers\Backend\BackendController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localize','localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function (){

    Route::prefix('ctrl')->controller(AuthBackendController::class)->as('backend.')->name('backend.auth.')->group(function() {
        Route::get('register', 'showRegisterForm')->name('showRegisterForm')->middleware('guest');
        Route::post('register', 'register')->name('register')->middleware('guest');
        Route::get('login', 'showLoginForm')->name('showLoginForm')->middleware('guest');
        Route::post('login', 'login')->name('login')->middleware('guest');
//        Route::post('logout', 'logout')->name('logout')->middleware(['backend','role:admin|manager']);
        Route::post('logout', 'logout')->name('logout')->middleware(['backend']);
    });
    // Route::group(['prefix' => 'back', 'as'=>'backend.', 'middleware' => ['backend','role:admin|manager']], function (){
     Route::group(['prefix' => 'ctrl', 'as'=>'backend.', 'name'=>'backend.', 'middleware' => ['backend']], function (){
        Route::controller(BackendController::class)->group(function() {
            Route::get('/', 'index')->name('index');
        });


    });




//    Route::group(['prefix'=>'user'],function(){
//        Route::get('/index',[UserConroller::class, 'index'])->name('user.index');
//        Route::get('/create',[UserConroller::class, 'create'])->name('user.create');
//        Route::post('/store',[UserConroller::class, 'store'])->name('user.store');
//        Route::get('/edit/{id}',[UserConroller::class, 'edit'])->name('user.edit');
//        Route::put('/update/{id}',[UserConroller::class, 'update'])->name('user.update');
//        // Route::get('/show/{id}',[UserConroller::class, 'show'])->name('user.show');
//        Route::delete('/destroy/{id}',[UserConroller::class, 'destroy'])->name('user.destroy');
//    });
//
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


});
