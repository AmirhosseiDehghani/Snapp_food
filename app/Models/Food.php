<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'price',
        'is_foodparty',
        'make_of',
    ];

    //-------------- Relationships----------------//
    public function categories()
    {
        return $this->morphToMany(Category::class,'categorizable');
    }
    public function images()
    {
        return $this->morphMany(Images::class, 'imagesable');
    }
    public function discount()
    {
        return $this->belongsTo(Discounts::class);
    }
    public function Restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }



}
