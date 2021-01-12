<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
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

});




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();


Route::group(['prefix'=>'admin'],function(){   
    
    Route::get('/test', [App\Http\Controllers\AdminController::class, 'test'])->name('admin.test');
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');
    Route::get('/crud', [App\Http\Controllers\CRUDController::class, 'index'])->name('admin.crud');
    Route::post('/crud', [App\Http\Controllers\CRUDController::class, 'crud'])->name('crud.create');

});


