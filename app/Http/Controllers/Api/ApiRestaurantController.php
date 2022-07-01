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
        $a= Category::whereFood()->with('food')
        ->whereHas('food',function(Builder $query)
        {
            $query->whereRelation('Restaurant','id','=',1);
        })->get();
        response()->json($a);
        // return $a;
    }
}
