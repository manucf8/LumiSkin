<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'All Categories';
        $viewData['subtitle'] = 'List of all categories';
        $viewData['categories'] = Category::all();

        return view('category.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = 'Category';
        $viewData['subtitle'] = 'Form';

        return view('category.create')->with('viewData', $viewData);
    }

    public function store(Request $request): RedirectResponse
    {
        Category::validate($request);

        $newCategory = new Category;
        $newCategory->setName($request->input('name'));
        $newCategory->setDescription($request->input('description'));

        $newCategory->save();

        return redirect()->route('category.index')->with('success', 'Category created successfully!');

    }

    public function show($id): View
    {
        $viewData = [];
        $Category = Category::findOrFail($id);
        $viewData['title'] = $Category->getName().' ';
        $viewData['subtitle'] = $Category->getName().' - Category information';
        $viewData['category'] = $Category;

        return view('category.show')->with('viewData', $viewData);
    }

    public function delete($id): RedirectResponse
    {
        Category::destroy($id);

        return redirect()->route('category.index')->with('success', 'Category deleted successfully!');
    }
}
