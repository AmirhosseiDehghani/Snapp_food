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
    public function category()
    {
        return $this->morphOne(Category::class, 'categoriesable');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class,'user_id','id');
    }

    

    

}
