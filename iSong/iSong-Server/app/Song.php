<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = ['title', 'length', 'artist', 'data', 'user_id'];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
