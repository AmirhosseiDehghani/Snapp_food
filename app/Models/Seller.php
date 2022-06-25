<?php

namespace App\Models;

use App\Scopes\WhereSellerScopes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Seller extends User
{
     /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        // 'role' => $this->assignRole('Seller') ,
    ];
    protected $table='users';

    //--------------- Relationship --------------------//
    public function restaurants()
    {
        return $this->hasMany(Restaurant::class,'user_id');
    }
    
    //--------------- GET && Set Attribute --------------------//

    protected function role(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => 'Seller',
            // set: fn () => Role::SELLER
        );
    }

    protected static function booted()
    {
        static::addGlobalScope(new WhereSellerScopes);
    }
    
}
