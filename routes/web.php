<?php

use App\Http\Controllers\AdminEditUserController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Restaurant\KitchenCategorieController;
use App\Http\Controllers\Restaurant\RestaurantController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Restaurant\FloorPlanController;
use App\Http\Controllers\Restaurant\MenuController;

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
        Route::get('/create/{id?}',[RestaurantController::class,'create'])->name('createMainRestaurantPage')->where('id', '[0-9]+');;
        Route::post('/store/{id?}',[RestaurantController::class,'store'])->name('createRestaurant');
        Route::get('/{id?}',[RestaurantController::class,'index'])->name('getRestaurant')->where('id', '[0-9]+');
        Route::get('/edit/{id}',[RestaurantController::class,'edit'])->name('editRestaurant')->where('id', '[0-9]+');
        Route::put('/edit/{id}',[RestaurantController::class,'editData'])->name('editRestaurantData')->where('id', '[0-9]+');

        Route::group(['prefix' => 'floor_plan'], function(){
            Route::get('/{id}',[FloorPlanController::class,'index'])->name('floorPlan')->where('id', '[0-9]+');
            Route::get('/edit/{id}',[FloorPlanController::class,'edit'])->name('editFloorPlan')->where('id', '[0-9]+');
            Route::get('create/{id}',[FloorPlanController::class,'create'])->name('addFloorPlan')->where('id', '[0-9]+');
            Route::post('store/{id}',[FloorPlanController::class,'store'])->name('createFloorPlanData')->where('id', '[0-9]+');
            Route::post('update/{id}',[FloorPlanController::class,'update'])->name('updateFloorPlanData')->where('id', '[0-9]+');
        });

        Route::group(['prefix' => 'menu'], function(){
            Route::get('/{id}',[MenuController::class,'index'])->name('restMenu')->where('id', '[0-9]+');
            Route::get('/edit/{id}',[MenuController::class,'edit'])->name('restMenuEdit')->where('id', '[0-9]+');
            Route::post('/create/{id}',[MenuController::class,'create'])->name('restMenuCreate')->where('id', '[0-9]+');
            Route::delete('/delete/{id}',[MenuController::class,'delete'])->name('restMenuDelete')->where('id', '[0-9]+');
            Route::put('/update/{id}',[MenuController::class,'update'])->name('restMenuUpdate')->where('id', '[0-9]+');


        });



    });




});

Route::get('get_file',[FileController::class,'getFile'])->name('getFile');


