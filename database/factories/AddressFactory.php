<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'address'=>$this->faker->address,
            'lat'=>"35.".mt_rand (1000000000,9999999999),
            'long'=>"51.".mt_rand (1000000000,9999999999),
        ];
    }
}
