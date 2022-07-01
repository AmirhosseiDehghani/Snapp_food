<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable=
    [
        'title',
        'address',
        'lat',
        'long',
        'default'
    ];
    protected $visible=[
        'id',
        'title',
        'address',
        'lat',
        'long',
        'default'
    ];
    // ------------- Relationship
    public function addressable()
    {
        return $this->morphTo();
    }

}
