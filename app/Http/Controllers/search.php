<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class search extends Controller
{
    public function search(Request $request)
    {
        $key = trim($request->input('q'));
        $ebooks=DB::table('books')->where(DB::raw('lower(name)'), 'like', "%$key%")->orWhere(DB::raw('lower(author)'), 'like', "%$key%")
            ->get();
        $audio_books=DB::table('audio_books')->where(DB::raw('lower(name)'), 'like', "%$key%")->orWhere(DB::raw('lower(author)'), 'like', "%$key%")
            ->orWhere(DB::raw('lower(narrator)'), 'like', "%$key%")->get();
        $authors=DB::table('authors')->where(DB::raw('lower(name)'), 'like', "%$key%")->get();

        return view('pages.search_results')->with(compact('ebooks','audio_books','authors'));
    }
}
