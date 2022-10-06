<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reply extends Model
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
    public function comment()
    {
        return $this->belongsTo(comment::class);
    }
    public function like_reply()
    {
        return $this->hasMany(likeReply::class);
    }
}
