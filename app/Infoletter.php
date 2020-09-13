<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Infoletter extends Model
{
    public function agent(){

        return $this->belongsTo('App\User');
    }
}
