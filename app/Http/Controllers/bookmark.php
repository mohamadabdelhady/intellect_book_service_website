<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class bookmark extends Controller
{
    public function get_user_bookmarks()
    {
        $id=auth()->user()->id;
        $books=DB::select("SELECT * FROM books WHERE  id IN(SELECT book_id FROM bookmarks WHERE user_id=$id AND type= 0);");
        $audio=DB::select("SELECT * FROM audio_books WHERE  id IN(SELECT book_id FROM bookmarks WHERE user_id=$id AND type= 1);");
        return view('pages.user_bookmark')->with(compact('books','audio'));
    }
}
