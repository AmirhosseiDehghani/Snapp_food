<?php

namespace Database\Seeders;

use App\Models\Discounts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=5; $i <100 ; $i+=5) { 
            
            Discounts::query()->create([
                'name'=>'Discount%'.$i,
                'discount'=>$i
            ]);
        }
    }
}
