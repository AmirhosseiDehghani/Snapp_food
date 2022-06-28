<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

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
        return [
            'day'=>Arr::random($Week),
            'open_time'=>$this->faker->time('H:i'),
            'close_time'=>$this->faker->time('H:i'),
        ];
    }
}
