<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Product;

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

        return view('product.index')->with('viewData', $viewData);
    }
}
