<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;

class RestaurantDateController extends Controller
{
    public function store(Request $request,$id)
    {
        // dd(User::query()->find(auth()->id())->getAllPermissions()->toArray());
        if(!auth()->user()->hasPermissionTo('edits restaurant')){
            return back();
        }
        $restaurant=Restaurant::query()->find($id);
        if(!$restaurant->users->first()->id==auth()->id()){
            return back();
        }
        $validate=$request->validate([
            // 'open_time'=>'',
        ]);
        // dd($request->all());
        $restaurant->dates()->create($request->all());
        return back();
    }

    public function destroy(Request $request , $id)
    {
        if(!auth()->user()->hasPermissionTo('edits restaurant')){
            return back();
        }
        $restaurant=Restaurant::query()->find($id);
        if(!$restaurant->users->first()->id==auth()->id()){
            return back();
        }
        // $validate=$request->validate([
        //     // 'open_time'=>'',
        // ]);
        // dd($request->all());
        $restaurant->dates()->find($request->get('date_id'))->delete();
        return back();
    }
}
