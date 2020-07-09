<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentAnswer extends Model
{
    protected $table = 'answer_comments';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function answer(){
        return $this->belongsTo('App\Answer');
    }
}
