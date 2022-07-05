<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable=
    [
        'name',
        'description',
        'type',
    ];
    // protected $hidden=[

    // ];
    //------------- Relationship---------------//
     /**
     * Get all of Category tags for the post.
     */
   
    public function restaurants()
    {
        return $this->morphedByMany(Restaurant::class, 'categorizable');
    }
    public function food()
    {
        return $this->morphedByMany(Food::class, 'categorizable');
    }

    //------------- Scope---------------//
    public function scopeWhereRestaurant($query)
    {
        $query->where('type','restaurant');
    }
    public function scopeWhereFood($query)
    {
        $query->where('type','food');
    }


}
