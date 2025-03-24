<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SkincareTest;
use App\Services\ChatGPTService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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

    public function getRecommendation(SkincareTest $test): View
    {
        $recommendationText = $test->recommendations;

        $recommendedProductNames = Product::extractProductNames($recommendationText);

        $recommendedProducts = Product::whereIn('name', $recommendedProductNames)->get();

        $explanation = session('explanation');

        $viewData = [
            'title' => 'Product Recommendations',
            'subtitle' => 'Based on your answers, here are our product recommendations',
            'recommendedProducts' => $recommendedProducts,
            'explanation' => $explanation,
            'noProductsMessage' => 'No products found',
        ];

        return view('skincare_test.recommendation')->with('viewData', $viewData);
    }

    public function store(Request $request): RedirectResponse
    {
        SkincareTest::validate($request);

        $test = new SkincareTest;
        $test->user_id = Auth::id();
        $test->setResponses($request->responses);
        $test->save();

        $userResponses = $request->responses;
        $products = Product::all(['name', 'description', 'brand', 'price']);

        if ($products->isEmpty()) {

            $recommendationText = 'We currently have no products in the store to recommend. Please check back soon!';
            $explanation = '';

        } else {

            $recommendationText = $this->chatGPTService->getRecommendationFromProducts($userResponses, $products);

            $recommendedProductNames = Product::extractProductNames($recommendationText);

            $recommendedProducts = Product::whereIn('name', $recommendedProductNames)->get();

            if ($recommendedProducts->isEmpty()) {
                logger('No products found for recommendation');
            } else {
                $test->recommendations()->sync($recommendedProducts->pluck('id'));
            }

            $explanation = preg_replace('/- Product name: .+/', '', $recommendationText);
            $explanation = trim($explanation);
        }

        return redirect()->route('skincare_test.recommendation', ['test' => $test->id])->with('explanation', $explanation);
    }
}
