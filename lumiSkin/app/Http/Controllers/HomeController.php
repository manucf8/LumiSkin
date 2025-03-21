<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Product;
use App\Models\Item;

class HomeController extends Controller
{
    public function index(): View
    {
        // Buscar productos más vendidos (con base en cantidad)
        $topProducts = Product::select('products.*')
            ->join('items', 'products.id', '=', 'items.product_id')
            ->selectRaw('SUM(items.quantity) as total_sold')
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->take(4)
            ->get();

        // Si no hay productos vendidos aún, mostrar los primeros 3 productos del catálogo
        if ($topProducts->isEmpty()) {
            $topProducts = Product::take(3)->get();
        }

        // Enviar datos a la vista
        $viewData = [];
        $viewData['title'] = 'Welcome to LumiSkin';
        $viewData['subtitle'] = 'Our best-selling products';
        $viewData['topProducts'] = $topProducts;

        return view('home.index')->with('viewData', $viewData);
    }
}
