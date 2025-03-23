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

    public function __construct(ChatGPTService $chatGPTService)
    {
        $this->chatGPTService = $chatGPTService;
    }

    public function getRecommendation(Request $request): JsonResponse
    {
        $userResponses = $request->all();

        $products = Product::all();

        if ($products->isEmpty()) {
            return response()->json([
                'recommendation' => 'Actualmente no tenemos productos en la tienda para recomendar. ¡Vuelve pronto!'
            ]);
        }

        $recommendation = $this->chatGPTService->getRecommendationFromProducts($userResponses, $products);

        return response()->json([
            'recommendation' => $recommendation
        ]);
    }

    public function index(): View
    {   
        $viewData = [];
        $viewData['title'] = 'Skincare Recommendation Test';
        $viewData['subtitle'] = 'Fill out the form to get your personalized skincare recommendation';

        return view('skincare_test.index')->with('viewData', $viewData);
    }

}
