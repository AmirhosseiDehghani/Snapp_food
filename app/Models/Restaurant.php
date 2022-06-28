<?php

namespace App\Models;

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
        // 'have_images',
    ];
    // protected $guarded=[
    //     'id'
    // ];
    protected $hidden=
    [
        'have_image'
    ];

    //---------------- Relationship-------------------//
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }
    // public function seller()
    // {
    //     return $this->belongsTo(Seller::class,'user_id','id');
    // }
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
    
    
    

    

    

}
