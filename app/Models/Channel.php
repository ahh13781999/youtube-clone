<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Videos()
    {
        return $this->hasMany(Video::class);
    }

    public function Subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function Subscribers()
    {
       return $this->Subscriptions->count();
    }

}
