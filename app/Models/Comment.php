<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at','desc');
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Video()
    {
        return $this->belongsTo(Video::class);
    }

    public function Replies()
    {
        return $this->hasMany(Comment::class,'reply_id','id');
    }
}
