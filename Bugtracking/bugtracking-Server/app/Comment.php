<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['title', 'content', 'data', 'bug_id'];

    public function bug() {
        return $this->belongsTo('\App\Bug');
    }
}
