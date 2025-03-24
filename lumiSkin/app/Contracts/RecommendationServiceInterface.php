<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface RecommendationServiceInterface
{
    public function getRoutine(string $prompt): mixed;

    public function getRecommendationFromProducts(array $userResponses, Collection $products): mixed;
}
