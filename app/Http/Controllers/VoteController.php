<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\support\Facades\Auth;

use App\QuestionVotes;
use App\Question;
use App\Point;

class VoteController extends Controller
{
    public function upvote_question($id){

        // menambahkan vote untuk pertanyaan tersebut
        $vote = QuestionVotes::firstOrCreate([
            'upvote'=>1,
            'downvote'=>0,
            'question_id'=>$id,
            'user_id'=>Auth::user()->id,
        ]);

        // memberikan point untuk pembuat pertanyaan
        $question = Question::find($id);
        $id_user = $question->user->id;
        $point_user = $question->user->point->point + 10;
        $new_point = Point::where('user_id','=',$id_user)->update(['point'=>$point_user]);

        return redirect("questions/$id");
    }

    public function downvote_question($id){
        // menambahkan vote untuk pertanyaan tersebut
        $vote = QuestionVotes::firstOrCreate([
            'upvote'=>0,
            'downvote'=>1,
            'question_id'=>$id,
            'user_id'=>Auth::user()->id,
        ]);

        // mengurangi point untuk yang memberikan downvote
        $point = Point::where('user_id','=',Auth::user()->id)->first()->point;
        $new_point = Point::where('user_id','=',Auth::user()->id)->update(['point'=>$point-1]);

        return redirect("questions/$id");
    }
}
