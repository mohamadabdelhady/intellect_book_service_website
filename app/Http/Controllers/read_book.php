<?php

namespace App\Http\Controllers;

use App\Models\books;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class read_book extends Controller
{
    public function check_book($id)
    {
        $book_data=DB::table('books')->select('cover_img','name','author','text','rating')->where('id','=',$id)->first();

//        dd($book_data);
        return view('pages.check_book')->with('book_data',$book_data);
    }
}
