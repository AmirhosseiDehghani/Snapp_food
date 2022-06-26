<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Date>
 */
class DateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $Week=['Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday',];
        $array=
        [
            // 'restaurant_id'=>Restaurant::class
        ];
        foreach ($Week as  $day) {
        $a= [
                ($day.'_S')=> $this->faker->time("H:i"),
               ($day.'_E')=> $this->faker->time("H:i"),
            ];
            $array=  array_merge($array,$a);
        }
        return $array;
    }
}
