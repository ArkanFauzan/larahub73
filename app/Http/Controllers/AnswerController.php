<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;

class AnswerController extends Controller
{
    public function store(Request $request){
        $new_answer = new Answer;
        $new_answer->content = $request['content'];
        $new_answer->question_id = $request['question_id'];
        $new_answer->save();
        // dd($new_answer);
        $nampung = $new_answer['question_id'];
        if($nampung){
            return redirect("/questions/$nampung");
        }
    }
}
