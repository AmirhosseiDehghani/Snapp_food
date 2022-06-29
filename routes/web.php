<?php

use App\Http\Controllers\Admin\AdminCategoryFood;
use App\Http\Controllers\Admin\AdminCategoryRestaurant;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDiscount;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RestaurantsController;
use App\Http\Controllers\Seller\RestaurantAddressUpdateController;
use App\Http\Controllers\Seller\RestaurantCategoryController;
use App\Http\Controllers\Seller\RestaurantDateController;
use App\Http\Controllers\Seller\SellerSiteController;
use App\Http\Controllers\Seller\SellerUpdateController;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

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
// Route::post('/test',function(){


//     redirect('/test');
// return response()->json(request('successful'));


// });

// Route::get('/test',function(){

// return response()->json(request('lat'));

// // return response()->json('hello');

// });

Route::view('/','home')->name('home');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('homeRedirect',HomeController::class)->name('homeRedirect');

Route::middleware('auth')->group(function (){


    // Admin
    Route::middleware('isAdmin')->name('Admin.')->prefix('/Admin')->group(function()
    {
        Route::get('/home',[AdminController::class, 'index'])->name('home');

        Route::resource('Category/Restaurant',AdminCategoryRestaurant::class)->except(['edit','create']);
        Route::resource('Category/Food',AdminCategoryFood::class)->only(['index','show','store']);

        Route::resource('/Discount',AdminDiscount::class)->except(['edit','create']);

    });
    //Seller
    Route::middleware('isSeller')->name('Seller.')->prefix('Seller')->group(function()
    {
        Route::get('/home',[SellerSiteController::class,'home'])->name('home');

        Route::get('/profile',[SellerSiteController::class,'profile'])->name('profile');
        // Route::get('/profile/{}/e',[SellerSiteController::class,'profile'])->name('profile');
        Route::put('/profile',SellerUpdateController::class)->name('profile.update');
        
        Route::resource('/Restaurant',RestaurantsController::class);
        Route::name('Restaurant.')->group(function(){
            
            Route::put('Seller/Restaurant/{Restaurant}/Update/Address',RestaurantAddressUpdateController::class)
            ->name('updateAddress')->whereNumber('Restaurant');

            Route::delete('Seller/Restaurant/{Restaurant}/Delete/Category',[RestaurantCategoryController::class,'destroy'])
            ->name('deleteCategory')->whereNumber('Restaurant');
            Route::post('Seller/Restaurant/{Restaurant}/add/Category',[RestaurantCategoryController::class,'store'])
            ->name('addCategory')->whereNumber('Restaurant');

            Route::post('Seller/Restaurant/{Restaurant}/Add/Day',[RestaurantDateController::class,'store'])
            ->name('addDay')->whereNumber('Restaurant');
            Route::delete('Seller/Restaurant/{Restaurant}/delete/Day',[RestaurantDateController::class,'destroy'])
            ->name('deleteDay')->whereNumber('Restaurant');
        });
    });
    

});
