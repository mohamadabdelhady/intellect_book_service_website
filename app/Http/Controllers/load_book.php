<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\books;
use App\Models\audio_books;
class load_book extends Controller
{
    public function get_all_books()
    {
        return $books=books::all();
    }
    public function get_all_audiobooks()
    {
        return $audiobooks=audio_books::all();
    }
}
