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

});


