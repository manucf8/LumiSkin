<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $query = Product::query();

        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        }

        $viewData = [];
        $viewData['title'] = 'List of Products';
        $viewData['subtitle'] = 'Discover our collection';
        $viewData['products'] = $query->get();
        $viewData['categories'] = Category::all();

        return view('product.index')->with('viewData', $viewData);
    }

    public function searchByCategory(Request $request): RedirectResponse|View
    {
        $categoryId = $request->input('category_id');

        if (! $categoryId) {
            return redirect()->route('product.index')->with('error', 'No category selected.');
        }

        $category = Category::findOrFail($categoryId);
        $products = $category->products()->paginate(10);

        $viewData = [];
        $viewData['title'] = 'List of Products';
        $viewData['subtitle'] = 'Discover our collection';
        $viewData['categories'] = Category::all();
        $viewData['products'] = $products;

        return view('product.index')->with('viewData', $viewData);
    }
}
