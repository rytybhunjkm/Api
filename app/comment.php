<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $guarded = [];

    public function post()
    {
        return $this->belongsTo(posts::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function like_comment()
    {
        return $this->hasMany(likeComment::class);
    }
    public function Reply()
    {
        return $this->hasMany(reply::class);
    }
}
