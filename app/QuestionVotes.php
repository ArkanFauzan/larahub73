<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionVotes extends Model
{
    protected $table = 'question_votes';
    protected $guarded = [] ;

    public function user(){
        return $this->belongsTo('App\User');
    }
}
