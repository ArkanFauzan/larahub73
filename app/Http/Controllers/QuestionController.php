<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use Illuminate\support\Facades\DB;
use App\Question;
use App\Answer;
use App\User;

// untuk firstOrCreate tabel point untuk user terkait
// ditaruh di index
use App\Point;


class QuestionController extends Controller
{
    public function index(){
        $questions = Question::all();
        
        // firstOrCreate table point for user who had login
        if(Auth::user()){
            $point = Point::firstOrCreate([
                'user_id'=> Auth::user()->id,
                'point'=>0,
            ]);

            /*
            point pembuat pertanyaan akan bertambah saat di vote, namun,
            ketika si pembuat pertanyaan login, maka akan dibuat data baru dengan point = 0 (duplicate)
            jadi ada nilai point sekarang dan 0 point untuk user yg sama
            makanya dihapus yg 0 pointnya
            */
            // dihapus apabila user_id pada tabel points lebih dari satu, yang dihapus yg memiliki 0 point
            if( count(Point::all()->where('user_id','=',Auth::user()->id)) !== 1 ){
                DB::table('points')->where('point','=',0)->where('user_id','=',Auth::user()->id)->delete();
            };
        }
        
        // var_dump($questions);
        return view('index', compact('questions'));
    }

    public function create(){
        return view('create');
    }

    public function store(Request $request){
        $new_question = new Question;
        $new_question->title = $request['title'];
        $new_question->content = $request['content'];
        $new_question->tag = $request['tag'];
        $new_question->user_id = Auth::user()->id;

        $new_question->save();
        return redirect('questions/index');


    }

    public function show($id){
        $answers = Answer::all()->where('question_id','=',$id);
        $question = Question::find($id);
        // dd($pertanyaan->isi);
        return view('show', compact('question', 'id','answers'));
    }

    public function edit($id){
        $question = Question::find($id);
        // dd($edited[0]->id);
        return view('edit', compact('question'));
    }

    public function update($id, Request $request){
        $question = Question::find($id);
        $question->title = $request['title'];
        $question->content = $request['content'];
        $question->tag = $request['tag'];

        $question->save();
        return redirect('/questions/index');
    }

    public function destroy($id){
        $question = Question::find($id);
        $question->delete();
        return redirect('/questions/index');
    }
}