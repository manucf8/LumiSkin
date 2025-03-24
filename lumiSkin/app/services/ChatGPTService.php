<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ChatGPTService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('OPENAI_API_KEY');
    }

    public function getRecommendationFromProducts($userResponses, $products): mixed
    {
        $prompt = 'Eres un experto en maquillaje. A continuación te paso las respuestas del usuario: '.json_encode($userResponses).
          '. Y estos son los productos disponibles en la tienda (no puedes inventar otros productos): '.json_encode($products).
          '. Tu tarea es recomendarle SOLO productos de la lista anterior, seleccionando los más adecuados según su tipo de piel, tono y preferencias. 
          Debes mencionar el NOMBRE del producto y su MARCA tal como aparece en la lista.';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'Eres un asesor de maquillaje profesional. Solo puedes recomendar productos de la tienda. Está prohibido inventar productos.'],
                ['role' => 'user', 'content' => $prompt],
            ],
            'max_tokens' => 500,
        ]);

        // Validación por si falla la API
        if ($response->successful()) {
            $data = $response->json();

            return $data['choices'][0]['message']['content'] ?? 'No se pudo generar la recomendación.';
        } else {
            return 'Error al conectar con ChatGPT: '.$response->body();
        }
    }
}
