<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bug extends Model
{
    protected $fillable =
        ['title', 'description', 'state', 'priority', 'user_id'];

    public function comments() {
        return $this->hasMany('\App\Comment');
    }

    public function user() {
        return $this->belongsTo('\App\User');
    }
}
