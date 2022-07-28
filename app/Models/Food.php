<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
    protected $appends=[
        'finalPrice'
    ];
    //-------------
    public function getFinalPriceAttribute(){
        if($this->attributes['discounts_id']==null){
            return $this->attributes['price'];
        }
        return (1-$this->discount->discount)*$this->attributes['price'];
        // return (1-Discounts::find($this->attributes['discounts_id'])->discount)*$this->attributes['price'];

    }
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
        return $this->belongsTo(Discounts::class,'discounts_id');
    }
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
    public function comments()
    {
        return $this->morphToMany(Comment::class, 'commentable')->whereNull('parent_id');
    }



}
