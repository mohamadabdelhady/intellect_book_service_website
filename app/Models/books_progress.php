<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class books_progress extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','book_id','progress','type',
    ];
}
