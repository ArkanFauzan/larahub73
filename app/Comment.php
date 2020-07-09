<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'answer_comments';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
