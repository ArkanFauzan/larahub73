<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;

use Illuminate\support\Facades\Auth;

class QuestionController extends Controller
{
    public function index(){
        $questions = Question::all();
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
        
        // $tagArr = explode(', ', $request->tag);
        
        // $tagMulti = [];
        // foreach ($tagArr as $strTag){
        //     $tagArrAscc['tag_name'] = $strTag;
        //     $tagMulti[] = $tagArrAscc;
        // }

        // foreach ($tagMulti as $tagCheck){
        //     $tag = Tag::firstOrCreate($tagCheck);
        //     $new_question->tags()->attach($tag->id);
            

        // }
        // dd($new_question);
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