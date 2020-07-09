<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentQuestion extends Model
{
    protected $table = 'question_comments';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
