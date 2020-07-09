<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Question extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
