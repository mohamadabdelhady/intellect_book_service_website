<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class genera extends Controller
{
    public function get_all_books($genera,$sort)
    {
        if($sort=="default")
        {
            $books=DB::table('books')->where('category','=',$genera)->paginate(10);
            return $books;
        }
        elseif ($sort=="rate")
        {
            $books=DB::table('books')->where('category','=',$genera)->orderBy('rating','desc')->paginate(10);
            return $books;
        }
        elseif ($sort=="newest")
        {
            $books=DB::table('books')->where('category','=',$genera)->orderBy('created_at','desc')->paginate(10);
            return $books;
        }
        elseif ($sort=="oldest")
        {
            $books=DB::table('books')->where('category','=',$genera)->orderBy('created_at')->paginate(10);
            return $books;
        }


    }
    public function get_all_audiobooks($genera,$sort)
    {
        if($sort=="default")
        {
            $books=DB::table('audio_books')->where('category','=',$genera)->paginate(10);
            return $books;
        }
        elseif ($sort=="rate")
        {
            $books=DB::table('audio_books')->where('category','=',$genera)->orderBy('rating','desc')->paginate(10);
            return $books;
        }
        elseif ($sort=="newest")
        {
            $books=DB::table('audio_books')->where('category','=',$genera)->orderBy('created_at','desc')->paginate(10);
            return $books;
        }
        elseif ($sort=="oldest")
        {
            $books=DB::table('audio_books')->where('category','=',$genera)->orderBy('created_at')->paginate(10);
            return $books;
        }
    }
    public function get_genera($genera)
    {

        return view('pages.genera')->with(compact('genera'));
    }
}
