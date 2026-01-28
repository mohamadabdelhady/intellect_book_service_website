<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        if (empty($query)) {
            $categories = Category::paginate(10);
        } else {
            $categories = Category::searchCategories($query)->paginate(10);
        }

        return view('Dashboard.admin.category.index', compact('categories', 'query'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
