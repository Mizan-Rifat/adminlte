<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Akaunting\Money\Currency;
use App\Http\Requests\NutritionalItemRequest;
use App\Models\AddableItem;
use App\Models\NutritionalItem;
use Illuminate\Support\Facades\Storage;

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

Route::get('/testview', function () {
    return view('test');
});
Route::get('/test', function () {
    NutritionalItem::factory()->count(10)->create();
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

    Route::group(['prefix'=>'ingredients'],function(){
        Route::get('/', [App\Http\Controllers\IngredientController::class, 'index'])->name('ingredients.index');
        Route::get('/create', [App\Http\Controllers\IngredientController::class, 'create'])->name('ingredients.create');
        Route::get('/edit/{ingredient}', [App\Http\Controllers\IngredientController::class, 'edit'])->name('ingredients.edit');
        Route::get('/destroy/{ingredient}', [App\Http\Controllers\IngredientController::class, 'destroy'])->name('ingredients.destroy');
        Route::post('/store', [App\Http\Controllers\IngredientController::class, 'store'])->name('ingredients.store');
        Route::post('/update/{ingredient}', [App\Http\Controllers\IngredientController::class, 'update'])->name('ingredients.update');
        Route::post('/bulkdestroy', [App\Http\Controllers\IngredientController::class, 'bulkdestroy'])->name('ingredients.bulkdestroy');
        Route::get('/{ingredient}', [App\Http\Controllers\IngredientController::class, 'show'])->name('ingredients.show');
    });

    Route::group(['prefix'=>'addableitems'],function(){
        Route::get('/', [App\Http\Controllers\AddableItemController::class, 'index'])->name('addableitems.index');
        Route::get('/create', [App\Http\Controllers\AddableItemController::class, 'create'])->name('addableitems.create');
        Route::get('/edit/{addableItem}', [App\Http\Controllers\AddableItemController::class, 'edit'])->name('addableitems.edit');
        Route::get('/destroy/{addableItem}', [App\Http\Controllers\AddableItemController::class, 'destroy'])->name('addableitems.destroy');
        Route::post('/store', [App\Http\Controllers\AddableItemController::class, 'store'])->name('addableitems.store');
        Route::post('/update/{addableItem}', [App\Http\Controllers\AddableItemController::class, 'update'])->name('addableitems.update');
        Route::post('/bulkdestroy', [App\Http\Controllers\AddableItemController::class, 'bulkdestroy'])->name('addableitems.bulkdestroy');
        Route::get('/{addableItem}', [App\Http\Controllers\AddableItemController::class, 'show'])->name('addableitems.show');
    });

    Route::group(['prefix'=>'nutritionalitems'],function(){
        Route::get('/', [App\Http\Controllers\NutritionalItemController::class, 'index'])->name('nutritionalitems.index');
        Route::get('/create', [App\Http\Controllers\NutritionalItemController::class, 'create'])->name('nutritionalitems.create');
        Route::get('/edit/{nutritionalItem}', [App\Http\Controllers\NutritionalItemController::class, 'edit'])->name('nutritionalitems.edit');
        Route::get('/destroy/{nutritionalItem}', [App\Http\Controllers\NutritionalItemController::class, 'destroy'])->name('nutritionalitems.destroy');
        Route::post('/store', [App\Http\Controllers\NutritionalItemController::class, 'store'])->name('nutritionalitems.store');
        Route::post('/update/{nutritionalItem}', [App\Http\Controllers\NutritionalItemController::class, 'update'])->name('nutritionalitems.update');
        Route::post('/bulkdestroy', [App\Http\Controllers\NutritionalItemController::class, 'bulkdestroy'])->name('nutritionalitems.bulkdestroy');
        Route::get('/{nutritionalItem}', [App\Http\Controllers\NutritionalItemController::class, 'show'])->name('nutritionalitems.show');
    });

});

