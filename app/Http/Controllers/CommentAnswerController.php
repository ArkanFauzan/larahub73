<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\CommentAnswer;

class CommentAnswerController extends Controller
{
    public function store($id, Request $request){
        $comments = CommentAnswer::create([
            'content'=>$request['comment'],
            'answer_id'=>$id,
            'user_id'=>Auth::user()->id,
        ]);

        return redirect("/questions/".$comments->answer->question->id);
    }
}
