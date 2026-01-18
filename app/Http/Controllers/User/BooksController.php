<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index($sort,$type)
    {
        return Book::sorted($sort)->ofType($type)->paginate(10);
    }

     public function show($id)
    {
        $book=Book::findOrFail($id);
        if($book->type=='audiobook')
        return view('User.check_audio')->with(compact('book'));
        else
        return view('User.check_book')->with(compact('book'));
    }

    public function readOrListen($id,$type)
    {
        $book=Book::findOrFail($id);
        if($type=='book')
        return view('User.read')->with(compact('book'));
        else if($type=='audiobook')
        return view('User.listen')->with(compact('book'));

        return abort(404);
    }

    public function search(Request $request)
    {
       $books=Book::searchBooks($request->input('query'))->ofType('book')->get();
       $audiobooks=Book::searchBooks($request->input('query'))->ofType('audiobook')->get();
       $authors=Author::searchAuthors($request->input('query'))->get();
       return view('User.search_results')->with(compact('books','audiobooks','authors'));
    }

    public function getAuthor($author)
    {
        $data=Author::getAuthorById($author);
        $books=Book::ofAuthor($author)->ofType('book')->get();
        $audio=Book::ofAuthor($author)->ofType('audiobook')->get();
        return view('User.about_author')->with(compact('data','books','audio'));
    }
}
