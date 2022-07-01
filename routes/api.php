<?php

use App\Http\Controllers\Api\ApiRestaurantController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Buyer\BuyerAddressController;
use App\Http\Controllers\Api\Buyer\BuyerController;
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
    
    Route::apiResource('/addresses',BuyerAddressController::class);
    Route::post('/addresses/{id}',[BuyerAddressController::class,'setAddress'])->whereNumber('id');

    Route::patch('/Buyer',[BuyerController::class,'update']);



    Route::post('/logout', [AuthController::class, 'logout']);
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });




Route::get('/test',function(){

});
