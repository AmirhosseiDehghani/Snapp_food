<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Restaurant::class, 'restaurant');
    }
    /**
     * Display a listing of the resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=auth()->user();
        // $Restaurants= Restaurant::query()->whereMorphRelation((new Restaurant)-> users(),User::class,'user_id')->get();
        $Restaurants=$user->restaurants()->paginate(10);
        // $address=$user->restaurants()->address;

        // dd($Restaurants);
        return  view('Restaurant.restaurantIndex',compact('Restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(User::find(auth()->id())->hasRole('Seller'));
        User::find(auth()->id())->hasRole('Seller');
        $Week=[
            'Saturday',
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
        ];
      $Category=  Category::query()->whereRestaurant()->get();
        return  view('Restaurant.restaurantCreate',compact('Category','Week'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRestaurantRequest  $request
    //  * @return \Illuminate\Http\Response
     */
    public function store(StoreRestaurantRequest $request)
    {
        // dd
        // (
        //     // $request->all()  
        // //     // \App\Classes\TimeRestaurantHandler::getDepartMinAndHourTurnToH_M($request->all())
        //     $request->validated()
        // );

        $user=User::find(auth()->id());
        $Category=Category::find($request->validated()['category']);
        
        $Restaurant=Restaurant::create($request->validated());

        $Restaurant->address()->create($request->validated());

        $Restaurant->categories()->save($Category);
        $Restaurant->users()->save($user);
        
        return to_route('Seller.Restaurant.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
    //  * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
    //  * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRestaurantRequest  $request
     * @param  \App\Models\Restaurant  $restaurant
    //  * @return \Illuminate\Http\Response
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
    //  * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }
}
