<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\inventory\StockGroupController;
use App\Http\Controllers\inventory\WarehouseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware('auth')->group(function () {
    Route::controller(ListingController::class)->group(function () { 
        Route::get('/show-listing', 'index')->name('listing');
        Route::get('/create', 'create')->name('create');
        Route::post('/create-data', 'store')->name('create.data');
        Route::get('/edit-data/{id}', 'show')->name('edit.data');
        Route::post('/upate-data', 'update')->name('update.data');
        Route::get('/delete-data/{id}', 'delete')->name('delete.data');
        Route::get('/restore-data/{id}', 'restore')->name('restore.data');
        Route::get('/force-delete-data/{id}', 'forceDelete')->name('force.delete.data');
        Route::get('/about-us', 'about')->name('about');
        Route::get('/contact-us', 'contact')->name('contact');
   
    });
    Route::controller(HomeController::class)->group(function(){
        Route::get('/home','index')->name('home');
    });
    // routes for inventories--------------------------
    // warehouse
    Route::controller(WarehouseController::class)->group(function(){
        Route::get('/warehouse','index')->name('warehouse');
        Route::get('/warehouse/fetch-data','fetch_data')->name('warehouse.fetch');
        Route::post('/warehouse','store')->name('warehouse.create');
        Route::get('/warehouse/edit-data/{id}','show')->name('warehouse.edit');
        Route::get('/warehouse/delete-data/{id}','delete')->name('warehouse.delete');
    });
    Route::controller(StockGroupController::class)->group(function(){
        Route::get('/stock-group','index')->name('stock_group');
        Route::get('/stock-group/fetch-data','fetch_data')->name('stock_group.fetch');
    });

});
Route::get('/',[UserController::class,'index'])->name('login')->middleware('guest');
Route::get('/create-account',[UserController::class,'create'])->name('account.create')->middleware('guest');
Route::post('/create-user',[UserController::class,'store'])->name('create.user');
Route::post('/login-user',[UserController::class,'login'])->name('login.user');
Route::get('/logout-user',[UserController::class,'logout'])->name('user.logout')->middleware('auth');
Route::get('/profile', [UserController::class,'profile'])->name('profile')->middleware('auth');
