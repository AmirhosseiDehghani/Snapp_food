<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use App\Models\Category;
use App\Models\Restaurant;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Arr;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFoodRequest  $request
    //  * @return \Illuminate\Http\Response
     */
    public function store(StoreFoodRequest $request,Restaurant $Restaurant)
    {

        $Restaurant->food()->create($request->validated());
        return back()->with('success','successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
    //  * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Food  $food
    //  * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $Restaurant, Food $Food)
    {
        // dd($Restaurant,$Food);
        $Categories=Category::whereFood()->get();
        return view('Restaurant.Food.foodEdit',compact('Restaurant','Food','Categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFoodRequest  $request
     * @param  \App\Models\Food  $food
    //  * @return \Illuminate\Http\Response
     */
    public function update(UpdateFoodRequest $request, Food $food)
    {
            $food->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food  $food
    //  * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        $food->delete();
    }
}
