<?php

namespace App\Models;

use App\Scopes\FinishOrder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable=[
        'data',
        'restaurant_id',
        'status',
    ];
     /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new FinishOrder);
    }
    //----------Mutator
    protected function data(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value,true),
            set: fn ($value) => json_encode($value),
        );
    }
    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => match($value) {
                '0'=>'Pending',
                '1'=>"Preparing food",
                '2'=>"courier delivery",
                '3'=>'Reaching to the destination'
            },
        );
    }
    //----------relationship
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
