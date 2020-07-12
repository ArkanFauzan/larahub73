<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use Illuminate\support\Facades\DB;
use App\Question;
use App\Answer;
use App\User;
use App\Tag;

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
        $new_question = Question::Create([
        'title' => $request['title'],
        'content' => $request['content'],
        'user_id' => Auth::user()->id
        ]);
        
        $tagArr = explode(', ', $request['tag']);
        $tagMulti = [];

        foreach ($tagArr as $strTag){
            $tagArrAsc['tag_name'] = $strTag;
            $tagMulti[] = $tagArrAsc;
        }

        foreach ($tagMulti as $tagCheck){
            $tags = Tag::firstOrCreate($tagCheck);
            $new_question->tag()->attach($tags->id);
        }

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

        // ambil nilai input pertanyaan
        $question = Question::find($id);
        $question->title = $request['title'];
        $question->content = $request['content'];

        // hapus data di tabel perantara question_tag untuk pertanyaan_id = $id
        DB::table('question_tag')->where('question_id','=',$id)->delete();

        // pecah request tag berdasarkan ", "
        $tagArr = explode(', ', $request['tag']);
        $tagMulti = [];

        foreach ($tagArr as $strTag){
            $tagArrAsc['tag_name'] = $strTag;
            $tagMulti[] = $tagArrAsc;
        }

        // ikat atau attach pertanyaan dengan setiap tag-tagnya
        foreach ($tagMulti as $tagCheck){
            $tags = Tag::firstOrCreate($tagCheck);
            $question->tag()->attach($tags->id);
        }

        // save nilai pertanyaan yang baru
        $question->save();

        return redirect('/questions/index');
    }

    public function destroy($id){
        $question = Question::find($id);
        $question->delete();
        return redirect('/questions/index');
    }
}