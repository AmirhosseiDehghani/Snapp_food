<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Users=User::all();
        $food=Food::all()->pluck('id');
        foreach($Users as $user){
            for ($i=0; $i < 20; $i++) {
                $user->cart()->create([
                    'food_id'=>   $food->random(),
                    'quantity'=>rand(1,5)
                ]) ;
            }
        }
    }
}
