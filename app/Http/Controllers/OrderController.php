<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class OrderController extends Controller
{


    /**
     * Display the specified resource.
     *
     * @param  int  $id
    //  * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $Restaurant,Order $order)
    {

       if(auth()->user()->hasPermissionTo('edits status food') )
        {
            return view('Restaurant.Order.orderShow',compact('Restaurant','order'));
       }else
       {
            abort(403,'you do not have permission to edit status');
       }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
    //  * @return \Illuminate\Http\Response
     */
    public function update(Restaurant $Restaurant,Order $order)
    {
        // dd($order);
        if(auth()->user()->hasPermissionTo('edits status food') )
        {   $flag=$order->status;
            $order->update(['status'=>(string) ((int) $flag+1)]);

            return ($flag==2) ?
            to_route('Seller.Restaurant.show',$Restaurant)
            :
            to_route('Seller.Restaurant.order.show',['Restaurant'=>$Restaurant,"order"=>$order]);

       }else
       {
            abort(403,'you do not have permission to edit status');
       }
    }
}
