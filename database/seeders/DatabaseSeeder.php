<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        (new MakePermissionAndRoleSeeder)->run();

        // DB::table('users')->insert([
        //     'name'=>'admin',
        //     'role'=>Role::query()->where('name','Admin')->get()->first()->id,
        //     'email'=>'admin@admin.com',
        //     'password'=>Hash::make(123)
        // ]);
        
        $admin=User::query()->create([
                'name'=>'admin',
                'email'=>'admin@admin.com',
                'password'=>Hash::make(123)
            ]);
        // $admin->assignRole('Admin');
        $admin->assignRole('Admin');
        
        

        $this->call([
            
            // MakePermissionAndRoleSeeder::class,
            // CategorySeeder::class,
            // DiscountsSeeder::class,
            SellerSeeder::class,
            // RestaurantSeeder::class,
            
        ]);


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

       
    }
}
