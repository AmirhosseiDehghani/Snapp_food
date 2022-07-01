<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfileUpdateRequest;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
     */
    public function __invoke(UserProfileUpdateRequest $request)
    {
        $flag=Seller::find(auth()->id())->update($request->validated());

        return($flag) ?
         back()->with('success','successful'):
         back()->with('fail','failed')
        ;
        
    }
}
