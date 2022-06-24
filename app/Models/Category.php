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
    //------------- Relationship---------------//
     /**
     * Get the parent imageable model (user or post).
     */
    public function categoriesable()
    {
        return $this->morphTo();
    }


}
