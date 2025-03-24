<?php

namespace App\Http\Controllers;

use App\Contracts\RecommendationServiceInterface;
use App\Models\Product;
use App\Models\SkincareTest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SkincareTestController extends Controller
{
    protected RecommendationServiceInterface $recommendationService;

    public function __construct(RecommendationServiceInterface $recommendationService)
    {
        $this->recommendationService = $recommendationService;
    }

    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Skincare Recommendation Test';
        $viewData['subtitle'] = 'Fill out the form to get your personalized skincare recommendation';

        $questions = json_decode(file_get_contents(public_path('data/questions.json')), true);
        $viewData['questions'] = $questions;

        return view('skincare_test.index')->with('viewData', $viewData);
    }

    public function getRecommendation(SkincareTest $test): View
    {
        $recommendedProducts = $test->recommendations()->get();

        $explanation = session('explanation');

        $viewData = [
            'title' => 'Product Recommendations',
            'subtitle' => 'Based on your answers, here are our product recommendations',
            'recommendedProducts' => $recommendedProducts,
            'explanation' => $explanation,
            'noProductsMessage' => 'No products found',
            'test' => $test,
        ];

        return view('skincare_test.recommendation')->with('viewData', $viewData);
    }

    public function generateRoutine(SkincareTest $test): View
    {
        $userResponses = $test->getResponses();
        $recommendedProducts = $test->recommendations()->get();

        $prompt = "You are a skincare expert. Below are the user's responses to a skincare test: ".json_encode($userResponses).
            '. Additionally, here are the recommended products based on their preferences: '.json_encode($recommendedProducts).
            '. Based on this, generate a detailed skincare routine including steps like cleansing, moisturizing, and sunscreen application.';

        $routineText = $this->recommendationService->getRoutine($prompt);

        $viewData = [
            'title' => 'Your Skincare Routine',
            'subtitle' => 'A personalized skincare routine based on your answers',
            'routine' => $routineText,
        ];

        return view('skincare_test.routine')->with('viewData', $viewData);
    }

    public function store(Request $request): RedirectResponse
    {
        SkincareTest::validate($request);

        $test = new SkincareTest;
        $user = Auth::user();
        if (! $user) {
            abort(403, 'Unauthorized');
        }
        $test->setUser($user);
        $test->setUser(Auth::user());
        $test->setResponses($request->responses);
        $test->save();

        $userResponses = $test->getResponses();
        $products = Product::all(['name', 'description', 'brand', 'price']);

        if ($products->isEmpty()) {

            $recommendationText = 'We currently have no products in the store to recommend. Please check back soon!';
            $explanation = '';

        } else {

            $recommendationText = $this->recommendationService->getRecommendationFromProducts($userResponses, $products);

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

        return redirect()->route('skincare_test.recommendation', ['test' => $test->getId()])->with('explanation', $explanation);
    }
}
