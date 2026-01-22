<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class AdminBookController extends Controller
{
    public function index()
    {
        return view('Dashboard.admin.books.index');
    }

    public function create()
    {
        return view('Dashboard.admin.books.create');
    }

    public function store()
    {

    }

    public function show(Book $book)
    {
        return view('Dashboard.admin.books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('Dashboard.admin.books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {

    }

    public function destroy(Book $book)
    {

    }
}
