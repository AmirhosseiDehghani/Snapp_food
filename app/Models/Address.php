<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable=
    [
        'address',
        'lat',
        'lang',
    ];
    // protected $visible=[

    // ];
    // ------------- Relationship
    public function addressable()
    {
        return $this->morphTo();
    }

}
