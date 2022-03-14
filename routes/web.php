<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use  App\Http\Controllers\PermissionController;
use App\Http\Controllers\MeController;
use App\Http\Controllers\AdminEditUserController;
use App\Http\Controllers\KitchenCategorieController;
use App\Http\Controllers\RestaurantController;

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

Auth::routes(['verify' => true]);

Route::group(['middleware' => 'verified'], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::group(['middleware' => ['auth']], function() {

    Route::group(['middleware' => ['role:Admin']], function(){
        Route::resource('roles', RoleController::class);
        Route::resource('users', AdminEditUserController::class);
        Route::resource('permissions', PermissionController::class);

    });

    Route::resource('kitchen_categories', KitchenCategorieController::class);

    Route::group(['prefix' => 'me'], function(){
        Route::get('/',[MeController::class,'index'])->name('profile');
        Route::get('/change_password',[MeController::class,'changePassword'])->name('change_password');
    });

    Route::group(['prefix' => 'restaurant'], function(){
        Route::get('/create',[RestaurantController::class,'create'])->name('createRestaurantPage');
     });



});


