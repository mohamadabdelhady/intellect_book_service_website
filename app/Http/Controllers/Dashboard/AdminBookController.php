<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class AdminBookController extends Controller
{
    public function index()
    {
        $books = Book::paginate(10);

        return view('Dashboard.admin.book.index', compact('books'));
    }

    public function create()
    {
        return view('Dashboard.admin.book.create');
    }

    public function store() {}

    public function show(Book $book)
    {
        return view('Dashboard.admin.book.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $authors = Author::all();

        return view('Dashboard.admin.book.edit', compact('book', 'authors'));
    }

    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'text' => 'required|string',
            'cover_img' => 'nullable|image|max:2048',
            'type' => 'required|string|max:100',
            'narrator' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('cover_img')) {
            $coverImagePath = $request->file('cover_img')->store('books/covers', 'public');
            $validatedData['cover_img'] = $coverImagePath;
        }

        $book->update($validatedData);

        return response()->json(['message' => 'Book updated successfully.']);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json(['message' => 'Book deleted successfully.']);
    }
}
