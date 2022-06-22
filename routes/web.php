<?php

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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::middleware('auth')->group(function (){
    // Admin
    Route::middleware('auth')->name('Admin.')->prefix('/Admin')->group(function()
    {
        Route::get('/home',[App\Http\Controllers\Admin\AdminController::class, 'index'])->name('home');

        // Route::resource('CategoryOfFood',AdminCategoryFood::class);

        // Route::resource('CategoryOfRestaurant',AdminCategoryRestaurant::class);

        
    });
    //Seller
    Route::name('Restaurant.')->prefix('Restaurant.')->group(function()
    {
        Route::get('/home',[]);

    });
    

});
