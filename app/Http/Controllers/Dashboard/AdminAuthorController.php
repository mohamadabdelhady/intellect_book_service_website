<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AdminAuthorController extends Controller
{
    public function index()
    {
        return view('Dashboard.admin.authors.index');
    }

    public function create()
    {
        return view('Dashboard.admin.authors.create');
    }

    public function store() {}

    public function show(Author $author)
    {
        return view('Dashboard.admin.authors.show', compact('author'));
    }

    public function edit(Author $author)
    {
        return view('Dashboard.admin.authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author) {}

    public function destroy(Author $author) {}
}
