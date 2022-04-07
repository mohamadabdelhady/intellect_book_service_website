<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class audio_books extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','author','text','cover_img','rating','narrator'
    ];
}
