<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentAnswer extends Model
{
    protected $table = 'answer_comments';
    protected $guarded = [];

    // untuk mengakses tabel user
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function answer(){
        return $this->belongsTo('App\Answer');
    }
}
