<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discuonts>
 */
class DiscountsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $flag= Arr::random(['percent','price']);
        if($flag=='percent'){
            $random=random_int(5,80);
            $name='Discount%'.$random;
        }else{
            $random=random_int(10000,25000);
            $name= $this->faker->name();
            
        }
        
        return [
            
            'name'=>$name,
            'type'=>$flag,
            'discount'=>$random,
           
        ];
    }
}
