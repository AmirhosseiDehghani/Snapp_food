<?php

namespace App\Http\Controllers\Seller\Food;

use App\Http\Controllers\Controller;
use App\Http\Requests\FoodChangeFoodPartyRequest;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class FoodChangeFoodPartyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
     */
    public function __invoke(FoodChangeFoodPartyRequest $request,Restaurant $Restaurant,Food $Food)
    {
        $Food->update(['is_foodparty'=>(!$Food->is_foodparty)]);
         return back();
    }
}
