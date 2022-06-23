<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerSiteController extends Controller
{
    public function home()
    {
        return  view('Seller.home');
    }
    public function profile()
    {
        return  view('Seller.profile');
    }
}
