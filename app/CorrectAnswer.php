<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CorrectAnswer extends Model
{
    protected $table = 'correct_answer';
    protected $guarded = [];

    public function answer(){
        return $this->belongsTo('App\Answer');
    }
}
