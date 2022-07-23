<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteKeyName()
    {
       return 'uid';   
    }

    public function getThumbnailAttribute()
    {
       return '/videos/'.$this->uid.'/'.$this->thumbnail_image;
    }

    public function Channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    public function dislikes()
    {
        return $this->hasMany(Dislike::class);
    }

    public function doesUserLikedVideo()
    {
        return $this->likes()->whereUserId(auth()->id())->exists();
    }

    public function doesUserDislikedVideo()
    {
        return $this->dislikes()->whereUserId(auth()->id())->exists();
    }

    public function Comments()
    {
        return $this->hasMany(Comment::class)->whereNull('reply_id');
    }

    public function AllCommentsCount()
    {
        return $this->hasMany(Comment::class)->count();
    }
}
