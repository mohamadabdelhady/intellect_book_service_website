<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserBookProgress;
use Illuminate\Http\Request;


class UserProgressController extends Controller
{
    public function create(Request $request)
    {
       UserBookProgress::setProgressForUser(
           auth()->user()->id,
           $request->input('book_id'),
           $request->input('progress'),
           $request->input('type'),
       );
       return response()->json(['status' => 'success']);
    }
    public function get($id)
    {
       $progress=UserBookProgress::progressForBook($id);
         return response()->json(['progress' => $progress]);
    }
}
