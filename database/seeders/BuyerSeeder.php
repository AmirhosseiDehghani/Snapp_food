<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::factory(20)->has(Cart::factory(20))->create();


        $users=User::all();
        foreach($users as $user)
        {
          if(!$user->hasAnyRole()){
            $user->assignRole('buyer');
          }
        }
    }
}
