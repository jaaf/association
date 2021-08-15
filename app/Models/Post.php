<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;  
    protected $fillable = [
        'title',
        'abstract',
        'body',
        'category',
        'diaporama_dir',
        'end_date',
        'beg_date',
        'receive_registration',
        'optional1',
        'optional2',
        'sticky',
        'author_id',
        'inscription_directive',
        'close_date'
    ];
}
