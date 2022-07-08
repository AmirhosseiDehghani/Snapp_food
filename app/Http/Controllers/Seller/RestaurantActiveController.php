<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantActiveRequest;
use App\Models\Restaurant;

class RestaurantActiveController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
     */
    public function __invoke(RestaurantActiveRequest $request,Restaurant $Restaurant)
    {
        // $flag=;
        $Restaurant->update(['is_Active'=>(!$Restaurant->is_Active)]);
        // dd($Restaurant);
        return back();
    }
}
