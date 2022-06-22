<?php

use App\Http\Controllers\Admin\AdminCategoryFood;
use App\Http\Controllers\Admin\AdminCategoryRestaurant;
use App\Http\Controllers\Admin\AdminDiscount;
use App\Http\Controllers\HomeController;
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

Route::view('/','home');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('homeRedirect',HomeController::class)->name('homeRedirect');

Route::middleware('auth')->group(function (){


    // Admin
    Route::middleware('auth')->name('Admin.')->prefix('/Admin')->group(function()
    {
        Route::get('/home',[App\Http\Controllers\Admin\AdminController::class, 'index'])->name('home');

        Route::resource('CategoryOfRestaurant',AdminCategoryRestaurant::class)->except(['edit','create']);
        Route::resource('CategoryOfFood',AdminCategoryFood::class)->only(['index','show','store']);

        Route::resource('/Discount',AdminDiscount::class)->except(['edit','create']);

    });
    //Seller
    Route::name('Restaurant.')->prefix('Restaurant')->group(function()
    {
        Route::get('/home',[]);

    });
    

});
