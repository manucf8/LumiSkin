<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

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

    public function newest(): View
    {
        $viewData = [];
        $viewData['title'] = 'New Arrivals';
        $viewData['subtitle'] = 'Discover our latest products';
        $viewData['products'] = Product::orderBy('created_at', 'desc')->limit(3)->get();

        return view('product.newest')->with('viewData', $viewData);
    }
}
