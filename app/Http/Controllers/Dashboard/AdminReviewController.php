<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BookReviews;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    public function index()
    {
        return view('Dashboard.admin.reviews.index');
    }

    public function create()
    {
        return view('Dashboard.admin.reviews.create');
    }

    public function store()
    {

    }

    public function show(BookReviews $review)
    {
        return view('Dashboard.admin.reviews.show', compact('review'));
    }

    public function edit(BookReviews $review)
    {
        return view('Dashboard.admin.reviews.edit', compact('review'));
    }

    public function update(Request $request, BookReviews $review)
    {

    }

    public function destroy(BookReviews $review)
    {

    }
}
