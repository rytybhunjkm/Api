<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class likeReply extends Model
{
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reply()
    {
        return $this->belongsTo(reply::class);
    }
}
