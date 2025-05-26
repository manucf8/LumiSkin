<?php

/**
 * Author:
 * - Manuela Castaño Franco
 */

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
        $category = Category::findOrFail($id);
        $viewData['title'] = $category->getName();
        $viewData['subtitle'] = $category->getName() . __('categories.info');
        $viewData['category'] = $category;

        return view('category.show')->with('viewData', $viewData);
    }
}
