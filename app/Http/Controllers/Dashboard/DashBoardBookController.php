<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class DashBoardBookController extends Controller
{
    public function index()
    {
        return view('dashboard.books.index');
    }

    public function create()
    {
        return view('dashboard.books.create');
    }

    public function store()
    {
        //
    }

    public function edit(Book $book)
    {
        return view('dashboard.books.edit')->with(compact('book'));
    }

    public function update()
    {
        //
    }
}