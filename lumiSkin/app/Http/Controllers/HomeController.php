<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $topProducts = Product::bestSellers();

        $viewData = [];
        $viewData['title'] = 'Welcome to LumiSkin';
        $viewData['subtitle'] = 'Our best-selling products';
        $viewData['topProducts'] = $topProducts;

        return view('home.index')->with('viewData', $viewData);
    }
}
