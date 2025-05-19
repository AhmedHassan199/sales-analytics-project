<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Http;

class RecommendationService
{
    protected OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getSalesData()
    {
        return $this->orderRepository->getSalesData();
    }

    public function getAIRecommendations($salesData): array|string
    {
        $apiKey = config('api_keys.gemini');
        $prompt = "Given this sales data, which products should we promote for higher revenue? " . json_encode($salesData);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}", [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ]
        ]);

        if ($response->failed()) {
            return [
                'error' => 'AI API call failed',
                'details' => $response->body()
            ];
        }

        return $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? 'No response';
    }

    public function getWeatherRecommendations(string $location = 'Alexandria'): array|string
    {
        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'q' => $location,
            'appid' => config('api_keys.openweather'),
            'units' => 'metric',
        ]);

        if ($response->failed()) {
            return 'Unable to fetch weather data. Please check the location or try again later.';
        }

        $weatherData = $response->json();
        $temperature = $weatherData['main']['temp'];

        [$recommendations, $dynamicPricing] = $this->getWeatherBasedPromotions($temperature);

        $cities = json_decode(file_get_contents(public_path('data/egypt_cities.json')), true);

        return [
            'weather' => $weatherData,
            'recommendations' => $recommendations,
            'dynamicPricing' => $dynamicPricing,
            'cities' => $cities
        ];
    }

    private function getWeatherBasedPromotions(float $temperature): array
    {
        if ($temperature > 30) {
            return ["Promote cold drinks and ice cream.", "Increase prices for cold drinks by 10%."];
        } elseif ($temperature < 20) {
            return ["Promote hot drinks and soups.", "Increase prices for hot drinks by 15%."];
        } else {
            return ["Promote balanced meal options.", "Keep prices stable."];
        }
    }
}
