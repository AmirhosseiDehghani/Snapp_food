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
        'category',
        'phone',
        'address',
        'account',
        'have_images',
    ];
    protected $hidden=
    [
        'have_image'
    ];

    //---------------- Relationship-------------------//
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }
    public function seller()
    {
        return $this->belongsTo(Seller::class,'user_id','id');
    }
    public function users()
    {
        return $this->morphToMany(User::class, 'userable');
    }
    public function date()
    {
        return $this->hasOne(Date::class);
    }
    
    

    

    

}
