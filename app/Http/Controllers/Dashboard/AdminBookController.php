<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\BookType;
use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminBookController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        if (empty($query)) {
            $books = Book::paginate(10);
        } else {
            $books = Book::searchBooks($query)->paginate(10);
        }

        return view('Dashboard.admin.book.index', compact('books', 'query'));
    }

    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();

        return view('Dashboard.admin.book.create', compact('authors', 'categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'author' => 'required|exists:authors,id',
            'category' => 'required|exists:categories,id',
            'file' => 'required|file|mimes:epub,mp3,wav,ogg',
            'text' => 'required|string',
            'cover_img' => 'required|image|max:2048',
            'type' => 'required|string|max:100',
            'narrator' => 'required_if:type,audiobook|string|max:255',
        ]);

        if ($request->hasFile('cover_img')) {
            $coverImagePath = $request->file('cover_img')->store('books/covers', 'public');
            $validatedData['cover_img'] = $coverImagePath;
        }

        $mime = $request->file('file')->getMimeType();
        if ($mime === 'application/epub+zip') {
            if ($request->type !== BookType::BOOK->value) {
                return response()->json(['file' => 'File type does not match the selected book type.'], 422);
            }

            $path = $request->file('file')->store('books/epub_files', 'public');
            $validatedData['file'] = $path;
        } elseif (str_starts_with($mime, 'audio/')) {
            if ($request->type !== BookType::AUDIOBOOK->value) {
                return response()->json(['file' => 'File type does not match the selected book type.'], 422);
            }

            $path = $request->file('file')->store('books/audio_files', 'public');
            $validatedData['file'] = $path;
        } else {
            return response()->json(['file' => 'Unsupported file type.'], 422);
        }

        $book = Book::create([
            'name' => $validatedData['name'],
            'author_id' => $validatedData['author'],
            'category_id' => $validatedData['category'],
            'text' => $validatedData['text'],
            'cover_img' => $validatedData['cover_img'],
            'type' => $validatedData['type'],
            'narrator' => $validatedData['narrator'] ?? null,
            'file_path' => $validatedData['file'],
        ]);

        return response()->json(['message' => 'Book created successfully.', 'book' => $book]);
    }

    public function show(Book $book)
    {
        return view('Dashboard.admin.book.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $authors = Author::all();
        $categories = Category::all();

        return view('Dashboard.admin.book.edit', compact('book', 'authors', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'author' => 'required|exists:authors,id',
            'category' => 'required|exists:categories,id',
            'file' => 'nullable|file|mimes:epub,mp3,wav,ogg',
            'text' => 'required|string',
            'cover_img' => 'nullable|image|max:2048',
            'type' => 'required|string|max:100',
            'narrator' => 'required_if:type,audiobook|string|max:255',
        ]);

        if (! $request->hasFile('cover_img') && ! $book->cover_img) {
            return response()->json(['cover_img' => 'Cover image is required.'], 422);
        }

        if ($request->hasFile('cover_img')) {
            $coverImagePath = $request->file('cover_img')->store('books/covers', 'public');
            $validatedData['cover_img'] = $coverImagePath;
        } else {
            $validatedData['cover_img'] = $book->cover_img;
        }

        if ($validatedData['type'] == $book->type) {
            $validatedData['file'] = $book->file_path;
        } else {

            if (! $request->hasFile('file')) {
                return response()->json(['file' => 'File is required when changing book type.'], 422);
            }

            $mime = $request->file('file')->getMimeType();
            if ($mime === 'application/epub+zip') {
                if ($request->type !== BookType::BOOK->value) {
                    return response()->json(['file' => 'File type does not match the selected book type.'], 422);
                }

                $path = $request->file('file')->store('books/epub_files', 'public');
                $validatedData['file'] = $path;
            } elseif (str_starts_with($mime, 'audio/')) {
                if ($request->type !== BookType::AUDIOBOOK->value) {
                    return response()->json(['file' => 'File type does not match the selected book type.'], 422);
                }

                $path = $request->file('file')->store('books/audio_files', 'public');
                $validatedData['file'] = $path;
            } else {
                return response()->json(['file' => 'Unsupported file type.'], 422);
            }
        }

        $book->update([
            'name' => $validatedData['name'],
            'author_id' => $validatedData['author'],
            'category_id' => $validatedData['category'],
            'text' => $validatedData['text'],
            'cover_img' => $validatedData['cover_img'],
            'type' => $validatedData['type'],
            'narrator' => $validatedData['narrator'] ?? null,
            'file_path' => $validatedData['file'],
        ]);

        return response()->json(['message' => 'Book updated successfully.', 'book' => $book]);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json(['message' => 'Book deleted successfully.']);
    }
}
