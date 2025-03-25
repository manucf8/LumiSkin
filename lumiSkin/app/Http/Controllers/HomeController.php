<?php

/**
 * Author:
 * - Juan Pablo Zuluaga Pelaez
 */

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $topProducts = Product::bestSellers();

        $viewData = [];
        $viewData['title'] = __('home.welcome');
        $viewData['subtitle'] = __('home.best_sellers');
        $viewData['topProducts'] = $topProducts;

        return view('home.index')->with('viewData', $viewData);
    }
}
