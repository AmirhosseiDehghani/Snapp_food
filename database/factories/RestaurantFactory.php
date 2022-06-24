<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name(),
            // 'category'=>$this->faker->title(),
            'phone'=>$this->faker->phoneNumber(),
            'address'=>$this->faker->address(),
            'account'=>$this->faker->randomNumber(6),
            
        ];
    }
}
