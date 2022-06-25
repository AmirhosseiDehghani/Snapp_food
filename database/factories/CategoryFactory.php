<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {   
        $a=Arr::random(['food','restaurant']);
        return [
            'name'=>"Category $a ".$this->faker->word(),
            'description'=>$this->faker->word(),
            'type'=>$a,
        ];
    }
}
