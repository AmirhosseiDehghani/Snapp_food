<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    use HasFactory;

    protected $fillable=[
        'day',
        'open_time',
        'close_time',
    ];
    //---------------- Relationship-------------------//
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    
}
