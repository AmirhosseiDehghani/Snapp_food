<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantAddressUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,$id)
    {
        $validate=$request->validate([
            'address'=>'required|string',
            "lat"=>'numeric',
            "long"=>'numeric',
            ]);
            Restaurant::query()->find($id)->address()->update($validate);
            // response()
            return back()->with('success','successful');
    }
}
