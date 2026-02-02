<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserBookProgress;
use Illuminate\Http\Request;

class UserBookProgressController extends Controller
{
    public function create(Request $request)
    {
        UserBookProgress::setProgressForUser(
            auth()->user()->id,
            $request->input('book_id'),
            $request->input('progress'),
        );

        return response()->json(['status' => 'success']);
    }

    public function get($id)
    {
        $progress = UserBookProgress::getProgressForUser(auth()->user()->id, $id);

        return response()->json(['progress' => $progress]);
    }
}
