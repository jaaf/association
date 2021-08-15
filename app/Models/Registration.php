<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'firstname',
        'familyname',
        'city',
        'optional1',
        'optional2',
        'remark',
        'post_id',
        'agent_id'
    ];
}
