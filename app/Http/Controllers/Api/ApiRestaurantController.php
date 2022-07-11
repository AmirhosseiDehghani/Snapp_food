<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantResource;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;


class ApiRestaurantController extends Controller
{
    public function index()
    {
        return RestaurantResource::collection(Restaurant::all());
    }

    public function show($id)
    {
        return new RestaurantResource(Restaurant::find($id));
    }
    public function restaurantFood($id)
    {
        $Category= Category::whereFood()->with('food')
        ->whereHas('food',function(Builder $query) use($id)
        {
            $query->whereRelation('Restaurant','id','=',$id);
        })->get();
        // $Category=Category::food()->get();
        


        // response()->json($Category);
        // return $a;
        // return
    }
}
