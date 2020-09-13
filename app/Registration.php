<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    public function post(){
        return $this->belongsTo('App\Post');
    }

    public function agent(){
        return $this->belongsTo('App\User');
    }
}
