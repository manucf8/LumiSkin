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
        $viewData['title'] = 'Lista de Productos';
        $viewData['subtitle'] = 'Explora nuestra colección';
        $viewData['products'] = $query->get();

        return view('product.index')->with('viewData', $viewData);
    }
}
