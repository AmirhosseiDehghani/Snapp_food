<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Models\Category;
use App\Models\Images;
use App\Models\User;
use Faker\Provider\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RestaurantsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Restaurant::class , 'Restaurant');
    }
    /**
     * Display a listing of the resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user=auth()->user();
        $Restaurants=$user->restaurants()->paginate(10);
        return  view('Restaurant.restaurantIndex',compact('Restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
       $image_path= Storage::put('images', $request->validated()['image']);

        $user=User::find(auth()->id());
        $Category=Category::find($request->validated()['category']);

        $Restaurant=Restaurant::create($request->validated());

        $Restaurant->address()->create($request->validated());
        $Restaurant->images()->create(['image_path'=>$image_path]);

        $Restaurant->categories()->save($Category);
        $Restaurant->users()->save($user);


        return to_route('Seller.Restaurant.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $Restaurant
    //  * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $Restaurant)
    {

        $Categories=Category::whereFood()->get();
        $Food=$Restaurant->food;
        $Orders=$Restaurant->orders;

        return view('Restaurant.restaurantShow',compact('Restaurant','Food','Categories','Orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $Restaurant
    //  * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $Restaurant)
    {

        $Address=$Restaurant->address;
        $Week=['Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday',];
        $Times=$Restaurant->Dates;


        return view('Restaurant.restaurantEdit',compact('Restaurant','Address','Week','Times'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRestaurantRequest  $request
     * @param  \App\Models\Restaurant  $Restaurant
    //  * @return \Illuminate\Http\Response
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $Restaurant)
    {
        $Restaurant->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $Restaurant
    //  * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $Restaurant)
    {

    }
}
