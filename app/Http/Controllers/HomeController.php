<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if( auth()->check() and auth()->user()->role==Role::ADMIN){
            return to_route('Admin.home');
        }
        if( auth()->check() and (auth()->user()->role==Role::SELLER or auth()->user()->role==Role::ADMIN ) ){
            return to_route('Seller.home');
        }
        return to_route('home');
        
    }
}
