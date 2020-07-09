<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Comment;

class CommentController extends Controller
{
    public function store($id, Request $request){
        $comments = Comment::create([
            'content'=>$request['comment'],
            'answer_id'=>$id,
            'user_id'=>Auth::user()->id,
        ]);

        return redirect("/questions/$id");
    }
}
