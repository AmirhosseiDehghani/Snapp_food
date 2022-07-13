<?php

use App\Http\Controllers\Api\ApiRestaurantController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Buyer\BuyerAddressController;
use App\Http\Controllers\Api\Buyer\BuyerController;
use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Public
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('restaurants',[ApiRestaurantController::class,'index']);
Route::get('restaurants/{id}',[ApiRestaurantController::class,'show'])->whereNumber('id');
Route::get('restaurants/{id}/food',[ApiRestaurantController::class,'restaurantFood'])->whereNumber('id');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('/addresses',BuyerAddressController::class);
    Route::post('/addresses/{id}',[BuyerAddressController::class,'setAddress'])->whereNumber('id');

    Route::patch('/Buyer',[BuyerController::class,'update']);
    //-----------------cart
    Route::prefix('Buyer')->group(function(){
        Route::get('/cart',[CartController::class,'getCart']);
        Route::get('/cart/info',[CartController::class,'getCartInfo']);
        Route::get('/cart/info/{id}',[CartController::class,'getCartId'])->whereNumber('id');
        Route::delete('/cart/{id}',[CartController::class,'deleteCart'])->whereNumber('id');
        Route::post('/cart',[CartController::class,'setCart']);

        Route::patch('/cart/add-food/{id}',[CartController::class,'addItemCart'])->whereNumber('id');
        Route::patch('/cart/sub-food/{id}',[CartController::class,'subItemCart'])->whereNumber('id');
        Route::delete('/cart/delete-food/{id}',[CartController::class,'deleteItemCart'])->whereNumber('id');

        Route::post('/cart/pay',[CartController::class,'payForCart']);
    });



});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });




Route::get('/test',function(){

});
