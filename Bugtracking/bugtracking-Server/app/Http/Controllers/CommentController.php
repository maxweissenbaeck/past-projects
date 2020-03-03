<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        //$request->validate(self::Rules);
        Comment::create($request->all());
    }
}
