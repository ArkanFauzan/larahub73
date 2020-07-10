<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CorrectAnswer;
use App\Answer;
use App\Question;
use App\Point;
use illuminate\support\Facades\Auth;

class CorrectAnswerController extends Controller
{
    public function store($id){
        $pertanyaan_id = Answer::find($id)->question->id;
        $correct_answer = CorrectAnswer::create([
            'question_id'=> $pertanyaan_id,
            'answer_id'=>$id
        ]);

        $jawbaan_terbaik = Answer::find($id);
        $id_user = Answer::find($id)->user_id;
        $point_user = $jawbaan_terbaik->user->point->point + 15;
        $new_point = Point::where('user_id','=',$id_user)->update(['point'=>$point_user]);

        return redirect('/questions/'.$pertanyaan_id);
    }
}
