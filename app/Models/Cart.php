<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // use HasFactory;
    protected $fillable=[
        'food_id',
        'cart_id',
        'quantity',
    ];
    protected $hidden=[
        'created_at',
        'updated_at',
    ];
    protected $attributes;
    public function getRestaurantIdAttribute()
    {
        return $this->food->restaurant->id;
    }
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function food()
    {
        return $this->belongsTo(Food::class);
    }
    // public function restaurant
    // {
    //     return $this->food()->restaurant;
    // }

}
