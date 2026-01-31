<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;

class GeneraController extends Controller
{
    public function getBooksByGenera($genera, $sort, $type)
    {
        return Book::ofCategory($genera)->ofType($type)->sorted($sort)->paginate(10);
    }

    public function getGenera($genera)
    {
        $genera = Category::findOrFail($genera);
        abort_if(! $genera, 404);

        return view('User.genera', compact('genera'));
    }
}
