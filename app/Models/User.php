<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Channel()
    {
       return $this->hasOne(Channel::class);
    }
    
    public function Owns(Video $video)
    {
        return $this->id  == $video->channel->user_id; 
    }

    public function Subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function subscribedChannels()
    {
        return $this->belongsToMany(Channel::class,'subscriptions');
    }

    public function isSubscribed(Channel $channel)
    {
        return (bool) $this->Subscriptions->where('channel_id',$channel->id)->count();
    }

    public function Comments()
    {
        return $this->hasMany(Comment::class);
    }
}
