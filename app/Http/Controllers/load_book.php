<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\books;
use App\Models\audio_books;
use Illuminate\Support\Facades\DB;

class load_book extends Controller
{
    public function get_all_books($sort)
    {
        if($sort=="default")
        {
            $books=DB::table('books')->paginate(10);
            return $books;
        }
        elseif ($sort=="rate")
        {
            $books=DB::table('books')->orderBy('rating','desc')->paginate(10);
            return $books;
        }
        elseif ($sort=="newest")
        {
            $books=DB::table('books')->orderBy('created_at','desc')->paginate(10);
            return $books;
        }
        elseif ($sort=="oldest")
        {
            $books=DB::table('books')->orderBy('created_at')->paginate(10);
            return $books;
        }

    }
    public function get_all_audiobooks($sort)
    {
        if($sort=="default")
        {
            $books=DB::table('audio_books')->paginate(10);
            return $books;
        }
        elseif ($sort=="rate")
        {
            $books=DB::table('audio_books')->orderBy('rating','desc')->paginate(10);
            return $books;
        }
        elseif ($sort=="newest")
        {
            $books=DB::table('audio_books')->orderBy('created_at','desc')->paginate(10);
            return $books;
        }
        elseif ($sort=="oldest")
        {
            $books=DB::table('audio_books')->orderBy('created_at')->paginate(10);
            return $books;
        }
    }
}
