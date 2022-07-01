<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Category;
use App\Models\Date;
use App\Models\Discounts;
use App\Models\Food;
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

    User::factory(20)->has
    (
      Restaurant::factory(rand(1,2))
      ->has
      (
        Category::factory(rand(1,3))
      )->has
      (
        Date::factory(rand(3,7))
      )->has
      (
        Address::factory()
      )
      ->has
      (
        Food::factory(rand(5,20))
        ->has
        (
          Discounts::factory(1)
        )
        ->has
        (
          Category::factory()
        )
      )
    )->create();

    $a= Restaurant::all()->load('categories');
    // dd($a);
    // return $a;
    foreach($a as $per){
        $per->categories()->update(['type'=>'restaurant']);
    }

    $food= Food::all()->load('categories');
    // dd($food);
    // return $food;
    foreach($food as $per){
        $per->categories()->update(['type'=>'food']);
    }
    
    // User::factory(10)->create()
    //   ->each(function($user)
    //   {
    //     Restaurant::factory(rand(1,2))->create()
    //       ->each(function())
    //     ;
    //   })
    // ;
    
    $users=User::all();
    foreach($users as $user)
    {
      if(!$user->hasAnyRole()){
        $user->assignRole('Seller');
      }
    }


  }
}
