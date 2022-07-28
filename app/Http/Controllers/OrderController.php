<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Restaurant;
use Carbon\Carbon;
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

    public function history(Request $request,Restaurant $Restaurant)
    {

        $filter=$request->get('filter')??1;
        if($filter==1)
        {
            // dd(Carbon::now()->subWeek(1)->toDateTimeString());
            $Orders= $Restaurant->orders()
             ->where('status', '=', '3')
             ->whereDate('created_at','>',Carbon::now()->subWeek(1)->toDateTimeString())
            ->paginate(10);

        }elseif($filter==2)
        {
            $Orders= $Restaurant->orders()
             ->where('status', '=', '3')
             ->whereDate('created_at','>',Carbon::now()->subMonth(1)->toDateTimeString())
           ->paginate(10);
        }else{
            $Orders= $Restaurant->orders()
             ->where('status', '=', '3')
           ->paginate(10);
        }
        $Sum=0;
        foreach ($Orders as   $order) {
            $Sum+=$order['data']['order']['total_price'];
        }
        // return$Orders;

        return view('Restaurant.Order.orderHistory',compact('Orders','Restaurant','Sum'));
    }
}
