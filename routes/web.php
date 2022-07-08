<?php

use App\Http\Controllers\Admin\AdminCategoryFood;
use App\Http\Controllers\Admin\AdminCategoryRestaurant;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDiscount;
use App\Http\Controllers\FoodChangeFoodPartyController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\FoodImageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RestaurantsController;
use App\Http\Controllers\Seller\Food\FoodChangeFoodPartyController as FoodFoodChangeFoodPartyController;
use App\Http\Controllers\Seller\RestaurantActiveController;
use App\Http\Controllers\Seller\RestaurantAddressUpdateController;
use App\Http\Controllers\Seller\RestaurantCategoryController;
use App\Http\Controllers\Seller\RestaurantDateController;
use App\Http\Controllers\Seller\SellerSiteController;
use App\Http\Controllers\Seller\SellerUpdateController;
use App\Models\Category;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;
use Illuminate\Database\Eloquent\Builder;
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

Route::get('/test',function(){

//    $a= Category::whereFood()->food()->whereBelongsTo(Restaurant::find(1))->get();
//    $a= Restaurant::find(1)->food()->with('categories')->get();
        $a= Category::whereFood()->with('food')
        ->whereHas('food',function(Builder $query)
        {
            $query->whereRelation('Restaurant','id','=',1);
        })->get();
        // $a=Food::query()->whereRelation('Restaurant','id','=',1)->get();

return $a;

});

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

        //-------------------Restaurant
        Route::resource('/Restaurant',RestaurantsController::class);
        Route::name('Restaurant.')->group(function(){

            Route::put('/Restaurant/{Restaurant}/Update/Address',RestaurantAddressUpdateController::class)
                ->name('updateAddress')->whereNumber('Restaurant')
            ;
            Route::delete('/Restaurant/{Restaurant}/Delete/Category',[RestaurantCategoryController::class,'destroy'])
                ->name('deleteCategory')->whereNumber('Restaurant')
            ;
            Route::post('/Restaurant/{Restaurant}/add/Category',[RestaurantCategoryController::class,'store'])
                ->name('addCategory')->whereNumber('Restaurant')
            ;
            Route::post('/Restaurant/{Restaurant}/Add/Day',[RestaurantDateController::class,'store'])
                ->name('addDay')->whereNumber('Restaurant')
            ;
            Route::delete('/Restaurant/{Restaurant}/delete/Day',[RestaurantDateController::class,'destroy'])
                ->name('deleteDay')->whereNumber('Restaurant')
            ;
            Route::post('/Restaurant/{Restaurant}/Active',RestaurantActiveController::class)
                ->whereNumber('Restaurant')->name('Active')
            ;


                //-------------------food
            Route::name("food.")->group(function(){
                Route::post('Restaurant/{Restaurant}/food/',[FoodController::class,'store'])
                    ->whereNumber('Restaurant')->name('store')
                ;
                Route::put('Restaurant/{Restaurant}/food/{Food}',[FoodController::class,'update'])
                    ->whereNumber(['Restaurant','Food'])->name('update')
                ;
                Route::delete('Restaurant/{Restaurant}/food/{Food}',[FoodController::class,'destroy'])
                    ->whereNumber(['Restaurant','Food'])->name('destroy')
                ;
                Route::get('Restaurant/{Restaurant}/food/{Food}/edit',[FoodController::class,'edit'])
                    ->whereNumber(['Restaurant','Food'])->name('edit')
                ;
                //IS there a way ?
                // Route::resource('Restaurant/{Restaurant}/food/',FoodController::class)
                    // ->whereNumber(['Restaurant',])
                // ;
                Route::post('/Restaurant/{Restaurant}/food/{Food}/foodparty',FoodFoodChangeFoodPartyController::class)
                    ->whereNumber('Restaurant')->name('party')
                ;
                Route::post('/Restaurant/{Restaurant}/food/{Food}/image',[FoodImageController::class,'store'])
                    ->whereNumber('Restaurant','Food')->name('image.store')
                ;
                Route::delete('/Restaurant/{Restaurant}/food/{Food}/image/{Images}',[FoodImageController::class,'destroy'])
                    ->whereNumber('Restaurant','Food','Images')->name('image.destroy')
                ;

            });
        });
    });


});
