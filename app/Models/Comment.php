<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;
    protected $fillable=[
        'body',
        'user_id',
        'parent_id',
    ];
    protected $hidden=[
        'user_id',
        'parent_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function commentable()
    {
        return $this->morphTo();
    }
    public function answer()
    {
        return $this->hasOne(Comment::class, 'parent_id');
    }
    public function replies()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
    public function comments()
    {
        return $this->morphOne(Comment::class, 'commentable');
    }
}
