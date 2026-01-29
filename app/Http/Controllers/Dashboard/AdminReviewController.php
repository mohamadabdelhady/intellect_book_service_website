<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookReviews;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    public function index(Book $book, Request $request)
    {
        $query = $request->input('query');
        if (! empty($query)) {
            $reviews = $book->reviews()->search($query)->paginate(10);
        } else {
            $reviews = $book->reviews()->paginate(10);
        }

        return view('Dashboard.admin.reviews.index', compact('book', 'reviews', 'query'));
    }

    public function create()
    {
        return view('Dashboard.admin.reviews.create');
    }

    public function store() {}

    public function show(BookReviews $review)
    {
        return view('Dashboard.admin.reviews.show', compact('review'));
    }

    public function edit(BookReviews $review)
    {
        return view('Dashboard.admin.reviews.edit', compact('review'));
    }

    public function update(Request $request, BookReviews $review) {}

    public function destroy(BookReviews $review) {}
}
