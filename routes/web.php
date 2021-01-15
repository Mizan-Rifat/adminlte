<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
return get_route('Role','bulkdestroy');
});



Auth::routes();


Route::group(['prefix'=>'admin'],function(){   
    
    Route::get('/test', [App\Http\Controllers\AdminController::class, 'test'])->name('admin.test');

    Route::post('/generate_permissions', [App\Http\Controllers\PermissionController::class, 'generatePermissions'])->name('generate_permissions');

    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');
    Route::get('/crud', [App\Http\Controllers\CRUDController::class, 'index'])->name('admin.crud');
    Route::post('/crud', [App\Http\Controllers\CRUDController::class, 'crud'])->name('crud.create');

    Route::group(['prefix'=>'profile'],function(){  
        Route::get('/', [App\Http\Controllers\ProfileController::class, 'show'])->name('admin.profile');
        Route::get('/change_password', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.password_change');
        Route::post('/change_avatar/{user}', [App\Http\Controllers\ProfileController::class, 'updateAvatar'])->name('profile.update_avatar');

    });

    Route::group(['prefix'=>'users'],function(){
        Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::get('/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
        Route::get('/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
        Route::get('/edit/{user}', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
        Route::get('/destroy/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
        Route::post('/store', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
        Route::post('/update/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
        Route::post('/bulkdestroy', [App\Http\Controllers\UserController::class, 'bulkdestroy'])->name('users.bulkdestroy');
        Route::post('/removeimage/{user}', [App\Http\Controllers\ProfileController::class, 'removeImage'])->name('users.removeimage');
    });
    
    Route::group(['prefix'=>'roles'],function(){
        Route::get('/', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
        Route::get('/create', [App\Http\Controllers\RoleController::class, 'create'])->name('roles.create');
        Route::get('/edit/{role}', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
        Route::get('/destroy/{role}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.destroy');
        Route::post('/store', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
        Route::post('/update/{role}', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
        Route::post('/bulkdestroy', [App\Http\Controllers\RoleController::class, 'bulkdestroy'])->name('roles.bulkdestroy');
        Route::get('/{role}', [App\Http\Controllers\RoleController::class, 'show'])->name('roles.show');
    });

    Route::group(['prefix'=>'permissions'],function(){
        Route::get('/', [App\Http\Controllers\PermissionController::class, 'index'])->name('permissions.index');
        Route::get('/create', [App\Http\Controllers\PermissionController::class, 'create'])->name('permissions.create');
        Route::get('/edit/{permission}', [App\Http\Controllers\PermissionController::class, 'edit'])->name('permissions.edit');
        Route::get('/destroy/{permission}', [App\Http\Controllers\PermissionController::class, 'destroy'])->name('permissions.destroy');
        Route::post('/store', [App\Http\Controllers\PermissionController::class, 'store'])->name('permissions.store');
        Route::post('/update/{permission}', [App\Http\Controllers\PermissionController::class, 'update'])->name('permissions.update');
        Route::post('/bulkdestroy', [App\Http\Controllers\PermissionController::class, 'bulkdestroy'])->name('permissions.bulkdestroy');
        Route::get('/{permission}', [App\Http\Controllers\PermissionController::class, 'show'])->name('permissions.show');
    });

        
    Route::group(['prefix'=>'categories'],function(){
        Route::get('/', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
        Route::get('/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
        Route::get('/edit/{category}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
        Route::get('/destroy/{category}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');
        Route::post('/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
        Route::post('/update/{category}', [App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
        Route::post('/bulkdestroy', [App\Http\Controllers\CategoryController::class, 'bulkdestroy'])->name('categories.bulkdestroy');
        Route::get('/{category}', [App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');
    });

});

