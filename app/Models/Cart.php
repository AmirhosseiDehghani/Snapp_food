<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable=[
        'food_id',
        'cart_id',
        'quantity',
    ];
    protected $hidden=[
        'created_at',
        'updated_at',
    ];

    protected function foodId(): Attribute
    {
        return new Attribute(
            set: fn ($value) => [
                'food_id' => $value,
                'cart_id' =>Food::find($value)->restaurant->id,
            ],
        );
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function food()
    {
        return $this->belongsTo(Food::class);
    }
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class,'cart_id');
    }

}
