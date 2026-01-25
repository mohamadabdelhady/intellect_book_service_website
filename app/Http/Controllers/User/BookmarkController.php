<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;

class BookmarkController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $books = Bookmark::getBookmarksForUser($user->id, 'book')->merge(Bookmark::getBookmarksForUser($user->id, 'audiobook'));
        $audiobooks = Bookmark::getBookmarksForUser($user->id, 'audiobook');

        return view('User.user_bookmark')->with(compact('books', 'audiobooks'));
    }

    public function create($id, $type)
    {
        Bookmark::addForUser(auth()->user()->id, $id, $type);

        return back();
    }

    public function destroy($id, $type)
    {
        Bookmark::removeForUser(auth()->user()->id, $id, $type);

        return back();
    }
}
