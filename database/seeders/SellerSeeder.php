<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Restaurant;
use App\Models\Seller;
use App\Models\User;
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

    User::factory(10)->has
    (
      Restaurant::factory(rand(1,2))->has
      (
        Category::factory(rand(1,3))
      ),
    )->create();
    
    $users=User::all();
    foreach($users as $user)
    {
      if(!$user->hasAnyRole()){
        $user->assignRole('Seller');
      }
    }

    }
}
