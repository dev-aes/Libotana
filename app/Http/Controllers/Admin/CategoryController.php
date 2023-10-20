<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index', [
            'categories' => Category::paginate(6)
        ]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function show(Category $category)
    {
        return view('admin.category.show', [
            'category' => $category
        ]);
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());

        return to_route('admin.categories.index')->with('success', 'Category Added Successfully');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', [
            'category' => $category
        ]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return to_route('admin.categories.index')->with('success', 'Category Updated Successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('success', 'Category Deleted Successfully');
    }
}