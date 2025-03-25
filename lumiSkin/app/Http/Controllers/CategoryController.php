<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('categories.all');
        $viewData['subtitle'] = __('categories.list');
        $viewData['categories'] = Category::all();

        return view('category.index')->with('viewData', $viewData);
    }

    public function show(int $id): View
    {
        $viewData = [];
        $Category = Category::findOrFail($id);
        $viewData['title'] = $Category->getName().' ';
        $viewData['subtitle'] = $Category->getName().__('categories.info');
        $viewData['category'] = $Category;

        return view('category.show')->with('viewData', $viewData);
    }
}
