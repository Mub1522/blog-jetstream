<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ], [
            'name.required' => __('The name field is required.'),
            'name.unique' => __('The category name already exists. Please choose another one.'),
        ]);

        Category::create($request->all());

        return redirect()->route('admin.categories.index')->with('status', __('The category has been created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.categories.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ], [
            'name.required' => __('The name field is required.'),
            'name.unique' => __('The category name already exists. Please choose another one.'),
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('admin.categories.index')->with('status', __('The category has been updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('status', __('The category has been deleted successfully.'));
    }
}
