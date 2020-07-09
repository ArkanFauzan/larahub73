<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\CommentQuestion;

class CommentQuestionController extends Controller
{
    public function store($id, Request $request){
        $comment = CommentQuestion::create([
            'content'=>$request['comment'],
            'question_id'=>$id,
            'user_id'=> Auth::user()->id,
        ]);

        return redirect("/questions/$id");
    }
    
}
