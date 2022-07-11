<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $flag=(rand(0,4)==0) ? rand(1,19): null;
        return [
            'name'=>$this->faker->company(),
            'price'=>$this->faker->numberBetween(5000,100000),
            "discounts_id"=>$flag
        ];
    }
}
