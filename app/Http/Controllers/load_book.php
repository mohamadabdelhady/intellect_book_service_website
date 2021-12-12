<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\books;
use App\Models\audio_books;
use Illuminate\Support\Facades\DB;

class load_book extends Controller
{
    public function get_all_books()
    {
          $books=DB::table('books')->paginate(10);
          return $books;
//            return $books=books::all();
    }
    public function get_all_audiobooks()
    {
        $audio_books=DB::table('audio_books')->paginate(10);
        return $audio_books;
    }
}
