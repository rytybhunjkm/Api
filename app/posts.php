<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
    protected $guarded = [];

    public function comment()
    {
        return $this->hasMany(comment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likepost()
    {
        return $this->hasMany(likePost::class);
    }
}
