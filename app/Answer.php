<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Answer extends Model
{
    public static function find_answer($id){
        $satu_jawaban = DB::table('answers')->where('question_id', $id)->get();
        return $satu_jawaban;
    }
}