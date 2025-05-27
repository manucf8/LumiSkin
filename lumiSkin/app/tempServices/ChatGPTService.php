<?php

/**
 * Author:
 * - Sara Valentina Cortes Manrique
 */

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
        $prompt = __(
            'skincare_test.makeup_recommendation_prompt',
            [
                'responses' => json_encode($userResponses),
                'products' => json_encode($products),
            ]
        );

        return $this->callChatGPT(
            systemMessage: __('skincare_test.makeup_system_message'),
            userPrompt: $prompt
        );
    }

    public function getRoutine(string $prompt): mixed
    {
        return $this->callChatGPT(
            systemMessage: __('skincare_test.skincare_system_message'),
            userPrompt: $prompt
        );
    }

    private function callChatGPT(string $systemMessage, string $userPrompt): mixed
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
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

            return $data['choices'][0]['message']['content'] ?? __('skincare_test.no_response');
        }

        return __('skincare_test.chatgpt_error') . $response->body();
    }
}
