<?php

namespace App\Http\Controllers;

use App\Classes\CartHandler;
use App\Http\Requests\CartRequest;
use App\Http\Resources\CartInfoCollection;
use App\Http\Resources\CartResource;
;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class CartController extends Controller
{
    public function getCart()
    {
        $Cart=new CartHandler;
        $Cart->getCart();
        return $Cart->output;
    }

    public function setCart(CartRequest $request)
    {
        // dd($request->validated());
        $Cart=new CartHandler;
        $Cart->setCart($request->validated());
        return $Cart->output;

        // return new CartResource($Cart->setCart($request->validated()));
    }

    public function addItemCart(Request $request,$id)
    {

        $Cart=new CartHandler;
        $Cart->addItemCard($id);
        return $Cart->output;
    }
    public function subItemCart($id)
    {
        $Cart=new CartHandler;
        $Cart->subItemCart($id);
        return $Cart->output;
    }
    public function deleteItemCart($id)
    {
        $Cart=new CartHandler;
        $Cart->deleteItemCart($id);
        return $Cart->output;

    }
    public function deleteCart($id)
    {
        $Cart=new CartHandler;
        $Cart->deleteCart($id);
        return $Cart->output;
    }
    public function getCartInfo()
    {
        $Cart=new CartHandler;
        $Cart->getCartInfo();
        return $Cart->output;
    }
    public function getCartId($id)
    {
        $Cart= new CartHandler;
        $Cart->getCartId($id);
        return$Cart->output;
    }
    public function payForCart()
    {
        $Cart=new CartHandler;
        return $Cart->payForCart();

    }

}
