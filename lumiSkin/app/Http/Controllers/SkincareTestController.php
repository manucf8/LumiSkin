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
        $viewData['title'] = __('skincare_test.title');
        $viewData['subtitle'] = __('skincare_test.form');

        $questions = json_decode(file_get_contents(public_path('data/questions.json')), true);
        $viewData['questions'] = $questions;

        return view('skincareTest.index')->with('viewData', $viewData);
    }

    public function getRecommendation(SkincareTest $test): View
    {
        $recommendedProducts = $test->recommendations()->get();

        $explanation = session('explanation');

        $viewData = [
            'title' => __('skincare_test.recommendations'),
            'subtitle' => __('skincare_test.based_on_answers'),
            'recommendedProducts' => $recommendedProducts,
            'explanation' => $explanation,
            'noProductsMessage' => __('skincare_test.no_products'),
            'test' => $test,
        ];

        return view('skincareTest.recommendation')->with('viewData', $viewData);
    }

    public function generateRoutine(SkincareTest $test): View
    {
        $userResponses = $test->getResponses();
        $recommendedProducts = $test->recommendations()->get();

        $prompt = __(
            'skincare_test.routine_prompt',
            [
                'responses' => json_encode($userResponses),
                'products' => json_encode($recommendedProducts),
            ]
        );

        $routineText = $this->recommendationService->getRoutine($prompt);

        $viewData = [
            'title' => __('skincare_test.routine'),
            'subtitle' => __('skincare_test.routine_desc'),
            'routine' => $routineText,
        ];

        return view('skincareTest.routine')->with('viewData', $viewData);
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

            $recommendationText = __('skincare_test.no_products_store');
            $explanation = '';

        } else {

            $recommendationText = $this->recommendationService->getRecommendationFromProducts($userResponses, $products);

            $recommendedProductNames = Product::extractProductNames($recommendationText);

            $recommendedProducts = Product::whereIn('name', $recommendedProductNames)->get();

            if ($recommendedProducts->isEmpty()) {
                logger(__('skincare_test.no_products'));
            } else {
                $test->recommendations()->sync($recommendedProducts->pluck('id'));
            }

            $explanation = preg_replace('/- Product name: .+/', '', $recommendationText);
            $explanation = trim($explanation);
        }

        return redirect()->route('skincareTest.recommendation', ['test' => $test->getId()])->with('explanation', $explanation);
    }
}
