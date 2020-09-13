<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    public function registrations(){
        return $this->hasMany('App\Registration');
    }

    public function author(){
            return $this->belongsTo('App\User');
    }
}
