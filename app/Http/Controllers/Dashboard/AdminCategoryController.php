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
        return view('Dashboard.admin.category.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $category = new Category;
        $category->name = $validatedData['name'];

        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('banners', 'public');
            $category->banner_img = $bannerPath;
        }

        $category->save();

        return response()->json(['message' => 'Category created successfully.', 'category' => $category]);
    }

    public function show(Category $category)
    {
        return view('Dashboard.admin.category.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('Dashboard.admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $category->name = $validatedData['name'];

        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('banners', 'public');
            $category->banner_img = $bannerPath;
        }

        $category->update([
            'name' => $category->name,
            'banner_img' => $category->banner_img,
        ]);

        return response()->json(['message' => 'Category updated successfully.', 'category' => $category]);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully.']);
    }
}
