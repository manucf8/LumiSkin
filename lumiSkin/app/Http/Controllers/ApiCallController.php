<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ApiCallController extends Controller
{
    public function showProductsFromApi(Request $request): View{

        
        $response = Http::get('http://tcg-merket.shop/api/tcgcards');
        $products = $response->json()['data'];

        $viewData = [];
        $viewData['title'] = 'Productos de la API Externa';
        $viewData['subtitle'] = 'Productos de la API Externa';
        $viewData['products'] = $products;
        
        return view('apiCall.index')->with('viewData', $viewData);
    }
    
}