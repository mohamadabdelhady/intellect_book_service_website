<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AdminAuthorController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        if (empty($query)) {
            $authors = Author::paginate(10);
        } else {
            $authors = Author::searchAuthors($query)->paginate(10);
        }

        return view('Dashboard.admin.author.index', compact('authors', 'query'));
    }

    public function create()
    {
        return view('Dashboard.admin.author.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'About' => 'required|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $photoImagePath = $request->file('photo')->store('authors/photos', 'public');
            $validatedData['photo'] = $photoImagePath;
        }

        $author = Author::create([
            'name' => $validatedData['name'],
            'About' => $validatedData['About'],
            'img' => $validatedData['photo'] ?? null,
        ]);

        return response()->json(['message' => 'Author created successfully.', 'author' => $author]);
    }

    public function show(Author $author)
    {
        return view('Dashboard.admin.author.show', compact('author'));
    }

    public function edit(Author $author)
    {
        return view('Dashboard.admin.author.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'About' => 'required|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $photoImagePath = $request->file('photo')->store('authors/photos', 'public');
            $validatedData['photo'] = $photoImagePath;
        }

        $author->update([
            'name' => $validatedData['name'],
            'About' => $validatedData['About'],
            'img' => $validatedData['photo'] ?? null,
        ]);

        return response()->json(['message' => 'Author updated successfully.', 'author' => $author]);
    }

    public function destroy(Author $author)
    {
        $author->delete();

        return response()->json(['message' => 'Author deleted successfully.']);
    }
}
