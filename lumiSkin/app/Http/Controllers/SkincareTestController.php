<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ChatGPTService;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SkincareTestController extends Controller
{
    protected $chatGPTService;

    public function index(): View
    {   
        $viewData = [];
        $viewData['title'] = 'Skincare Recommendation Test';
        $viewData['subtitle'] = 'Fill out the form to get your personalized skincare recommendation';

        $questions = json_decode(file_get_contents(public_path('data/questions.json')), true);
        $viewData['questions'] = $questions;

        return view('skincare_test.index')->with('viewData', $viewData);
    }

    public function __construct(ChatGPTService $chatGPTService)
    {
        $this->chatGPTService = $chatGPTService;
    }

    public function getRecommendation(Request $request): View
    {
        $userResponses = $request->all();
        $products = Product::all(['name', 'description', 'brand', 'price']);

        if ($products->isEmpty()) {
            $recommendation = 'We currently have no products in the store to recommend. Please check back soon!';
        } else {
            $recommendation = $this->chatGPTService->getRecommendationFromProducts($userResponses, $products);
        }

        $viewData = [];
        $viewData['title'] = 'Product Recommendations';
        $viewData['subtitle'] = 'Based on your answers, here are our product recommendations';
        $viewData['recommendation'] = $recommendation;

        return view('skincare_test.recommendation')->with('viewData', $viewData);
    }

}
