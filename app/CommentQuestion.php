<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentQuestion extends Model
{
    protected $table = 'question_comments';
    protected $guarded = [];

    // untuk mengakses tabel user
    public function user(){
        return $this->belongsTo('App\User');
    }
}
