<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable=
    [
        'name',
        // 'category',
        'phone',
        // 'address',
        'account',
        'is_Active',
        // 'have_images',
    ];
    protected $appends=[
        // 'oneImage'
    ];
    protected $hidden=
    [
        'created_at',
        'updated_at',
    ];


    //---------------- Relationship-------------------//
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    public function users()
    {
        return $this->morphToMany(User::class, 'userable');
    }

    public function dates()
    {
        return $this->hasMany(Date::class);
    }
    public function address()
    {
        return $this->morphOne(Address::class,'addressable');
    }
    public function images()
    {
        return $this->morphMany(Images::class,'imagesable');
    }
    public function food()
    {
        return $this->hasMany(Food::class);
    }
    public function carts()
    {
        return $this->hasMany(Cart::class,'cart_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }


    //-------------------Mutators
//     protected function make_of(): Attribute
// {
//     return Attribute::make(
//         get: function ($value, $attributes) {

//             return (is_null($value))? '-' :$value;
//         }
//     );
// }
    // public function getOneImageAttribute(){


    // }







}
