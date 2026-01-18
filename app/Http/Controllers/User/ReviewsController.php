<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BookReviews;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function index($id)
    {
        $reviews = BookReviews::getBookReviewsExceptUser(auth()->user()->id,$id)->paginate(10);
        return response()->json(['reviews' => $reviews]);
    }
    public function post(Request $request)
    {
        BookReviews::addForUser(
            auth()->user()->id,
            $request->input('book_id'),
            $request->input('review'),
            $request->input('rating'),
        );
        return response()->json(['status' => 'success']);
    }
    public  function update(Request $request)
    {
        BookReviews::updateForUser(
            auth()->user()->id,
            $request->input('book_id'),
            $request->input('review'),
            $request->input('rating'),
        );
        return response()->json(['status' => 'success']);
    }
    public function destroy($id,$type)
    {
        BookReviews::deleteForUser(auth()->user()->id, $id);
        return response()->json(['status' => 'success']);
    }
    public function show($id)
    {
        $review=BookReviews::getUserReviewForBook($id,auth()->user()->id);
        return response()->json(['review' => $review]);
    }
   
}
