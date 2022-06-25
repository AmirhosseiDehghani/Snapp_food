<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class MakePermissionAndRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //اگه خواستیش  باید در 
        //auth service provider
        // تغیر بدی
        // $roleAdmin = Role::create(['name' => 'Super Admin']);
        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleSeller = Role::create(['name' => 'Seller']);
        $roleBuyer = Role::create(['name' => 'Buyer']);
        
        // $AdminPermissions=[
            
        // ];

        $AllPermissions=[
            'add restaurant',
            'delete restaurant',
            'see restaurant',

            'see food',
            'delete food',
            'edits food',
            'see status food',
            'edits status food',
            'order food',

            'request for delete comment' 
        ];

        $SellerPermissions=[
            'add restaurant',
            'delete restaurant',
            'see restaurant',

            'see food',
            'delete food',
            'edits food',
            'see status food',
            'edits status food',

            'request for delete comment' 
        ];
        $BuyerPermissions=[

            'see food',
            'see status food',
            'order food',

            'see restaurant',
            


        ];

        foreach($AllPermissions as $permission){
            $permission = Permission::create(['name' => $permission]);
        }
       
        
        foreach($SellerPermissions as $permission){
            $roleSeller->givePermissionTo($permission);
        }
        
        foreach($BuyerPermissions as $permission){
            $roleBuyer->givePermissionTo($permission);
        }


    }
}
