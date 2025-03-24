<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData['title'] = 'Admin Page - Categories - Online Store';
        $viewData['categories'] = Category::all();

        return view('admin.category.index')->with('viewData', $viewData);
    }

    public function store(Request $request)
    {
        Category::validate($request);

        $newCategory = new Category;
        $newCategory->setName($request->input('name'));
        $newCategory->setDescription($request->input('description'));

        $newCategory->save();

        return back()->with('success', 'Category created successfully.');
    }

    public function delete($id)
    {
        Category::destroy($id);

        return back();
    }

    public function edit($id)
    {
        $viewData = [];
        $viewData['title'] = 'Admin Page - Edit Category - Online Store';
        $viewData['category'] = Category::findOrFail($id);
        $viewData['categories'] = Category::all();

        return view('admin.category.edit')->with('viewData', $viewData);
    }

    public function update(Request $request, $id)
    {
        Category::validate($request);

        $category = Category::findOrFail($id);
        $category->setName($request->input('name'));
        $category->setDescription($request->input('description'));

        $category->save();

        return redirect()->route('admin.category.index');
    }
}
