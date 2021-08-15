<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adherent extends Model
{
    use HasFactory; 
    protected $fillable = [
        'firstname',
        'familyname',
        'city',
        'registered',
        'cotisation',
        'email',
        'phone'
    ];
}
