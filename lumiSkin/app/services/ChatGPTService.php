<?php

namespace App\Services;

use App\Contracts\RecommendationServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;

class ChatGPTService implements RecommendationServiceInterface
{
    protected string $apiKey;

    protected string $apiUrl = 'https://api.openai.com/v1/chat/completions';

    protected string $model = 'gpt-3.5-turbo';

    public function __construct()
    {
        $this->apiKey = env('OPENAI_API_KEY');
    }

    public function getRecommendationFromProducts(array $userResponses, Collection $products): mixed
    {
        $prompt = "You are a makeup expert. Below I provide the user's responses: ".json_encode($userResponses).
            '. Additionally, these are the products available in the store (you cannot invent other products): '.json_encode($products).
            '. Your task is to recommend the most suitable products from the list above, based on their skin type, tone, and preferences. 
            **Important instructions**:
            1. You can recommend more than one product.
            2. Mention the PRODUCT NAME and BRAND as they appear in the list.
            3. Use the following format for each recommended product:
               - Product name: [Product name], Brand: [Brand]
            4. At the end, add a brief user-friendly explanation of why these products are ideal for them.
            
            **Example response**:
            - Product name: Matte Foundation, Brand: Maybelline
            - Product name: Intense Red Lipstick, Brand: MAC
            
            These products are ideal for you because they control shine and offer a long-lasting finish, perfect for your combination skin and preference for long-wear makeup.';

        return $this->callChatGPT(
            systemMessage: 'You are a professional makeup advisor. You can only recommend products from the store. Inventing products is prohibited.',
            userPrompt: $prompt
        );
    }

    public function getRoutine(string $prompt): mixed
    {
        return $this->callChatGPT(
            systemMessage: 'You are a skincare expert. Based on the user responses and the recommended products, generate a skincare routine.',
            userPrompt: $prompt
        );
    }

    private function callChatGPT(string $systemMessage, string $userPrompt): mixed
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->apiUrl, [
            'model' => $this->model,
            'messages' => [
                ['role' => 'system', 'content' => $systemMessage],
                ['role' => 'user', 'content' => $userPrompt],
            ],
            'max_tokens' => 500,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            return $data['choices'][0]['message']['content'] ?? 'Could not generate the response.';
        }

        return 'Error connecting to ChatGPT: '.$response->body();
    }
}
