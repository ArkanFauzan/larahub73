<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use Illuminate\support\Facades\Auth;

class AnswerController extends Controller
{
    public function store($id, Request $request){
        $new_answer = new Answer;
        $new_answer->content = $request['content'];
        $new_answer->question_id = $id;
        $new_answer->user_id = Auth::user()->id;
        $new_answer->save();
        
        $nampung = $new_answer['question_id'];
        if($nampung){
            return redirect("/questions/$nampung");
        }
    }
}