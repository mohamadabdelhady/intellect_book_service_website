<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;

class GeneraController extends Controller
{
    public function getBooksByGenera($genera, $sort, $type)
    {
        return Book::ofCategory($genera)->ofType($type)->sorted($sort)->paginate(10);
    }

    public function getGenera($genera)
    {
        abort_unless(in_array($genera, ['classics', 'history', 'science']), 404);

        return view('User.genera', compact('genera'));
    }
}
