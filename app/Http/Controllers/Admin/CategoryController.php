<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.pages.category.index', [
            'categories' => Category::all(),
        ]);
    }

    public function create(Request $request)
    {
        Category::create($request->all());

        return back();
    }

    public function edit(Category $category)
    {
        return back()->with([
            'data' => $category,
            'isModalOpen' => true,
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $category->update($request->all());

        return back();
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return back();
    }
}
