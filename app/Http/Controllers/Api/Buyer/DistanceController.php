<?php

namespace App\Http\Controllers\Api\Buyer;

use App\Classes\CartHandler;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistanceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $CartHandler=(new CartHandler);
        if($CartHandler->hasAddress()){
            $address=auth()->user()->addresses()->where('default',1)->get()->first()  ;
            $lat=$address->lat;
            $lon=$address->long;
            $restaurant=Restaurant::with('address')->addSelect([
                'distance'=>Address::query()->select
                    (
                    DB::raw("6371 * acos(cos(radians(" . $lat . "))
                    * cos(radians(addresses.lat))
                    * cos(radians(addresses.long) - radians(" . $lon . "))
                    + sin(radians(" .$lat. "))
                    * sin(radians(addresses.lat))) As distance ")
                    )->where("addressable_type",'App\Models\Restaurant')->whereColumn('addressable_id','restaurants.id')
            ])->orderBy('distance')->get();
            return $restaurant;
        }else{
            return $CartHandler->output();
        };
    }
}
