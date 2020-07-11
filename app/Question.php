<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Question extends Model
{
    protected $guarded = [];

    // untuk mengakses tabel user
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function comment(){
        return $this->hasMany('App\CommentQuestion');
    }

    public function votes(){
        return $this->hasMany('App\QuestionVotes');
    }

    public function correct_answer(){
        return $this->hasOne('App\CorrectAnswer');
    }

    public function tag(){
        return $this->belongsToMany('App\Tag');
    }

}
