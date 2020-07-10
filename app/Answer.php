<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Answer extends Model
{   
    // untuk mengakses tabel user
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function comment(){
        return $this->hasMany('App\CommentAnswer');
    }

    public function question(){
        return $this->belongsTo('App\Question');
    }

    public function votes(){
        return $this->hasMany('App\AnswerVotes');
    }
}