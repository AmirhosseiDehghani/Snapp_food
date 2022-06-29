<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discounts extends Model
{
    use HasFactory;
    protected $fillable=
    [
        'discount',
        'name',
    ];

    protected function discount(): Attribute   
    {
        return Attribute::make(
            get: fn ($value) => ($value/100),
            set: fn ($value) => fmod($value,100),
        );
    }


    public function food()
    {
        return $this->hasMany(Food::class);
    }

}
