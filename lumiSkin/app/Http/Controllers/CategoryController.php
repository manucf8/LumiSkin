<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

    public function show($id): View
    {
        $viewData = [];
        $Category = Category::findOrFail($id);
        $viewData['title'] = $Category->getName().' ';
        $viewData['subtitle'] = $Category->getName().' - Category information';
        $viewData['category'] = $Category;

        return view('category.show')->with('viewData', $viewData);
    }
}
