<?php

namespace Database\Factories;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $restaurants=Restaurant::all();
        $restaurant=$restaurants->find($restaurants->pluck('id')->random());
        // $User=User::all();
        return [
            'quantity'=>rand(1 ,10),
            'cart_id'=>$restaurant->id,
            'food_id'=>$restaurant->food()->find($restaurant->food()->pluck("id")->random())

        ];
    }
}
