<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Restaurant;
use App\Models\Seller;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Seller::factory()->count(5)
        ->has(
            Restaurant::factory(1)->hasAttached(
              Category::factory()->count(1)  
            )
        
        ,'restaurants')//has()
        ->create();

        Seller::factory()->count(1)
        ->has(
            Restaurant::factory(2)->hasAttached(
              Category::factory()->count(1)  
            )
        
        ,'seller')//has()
        ->create();

        // Seller::factory(1)->hasRestaurants(2)->create();
    }
}
