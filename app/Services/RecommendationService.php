<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Http;

class RecommendationService
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getSalesData()
    {
        return $this->orderRepository->getSalesData();
    }

    public function getAIRecommendations($salesData)
    {
        $apiKey = env('GEMINI_API_KEY'); // استبدل بالمفتاح الصحيح

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
            return ['error' => 'API call failed', 'details' => $response->body()];
        }

        $data = $response->json();

        return $data['candidates'][0]['content']['parts'][0]['text'] ?? 'No response';
    }




    public function getWeatherRecommendations($location = 'Alexandria')
    {
        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'q' => $location,
            'appid' => env('OPENWEATHER_API_KEY'),
            'units' => 'metric',
        ]);
        if ($response->failed()) {
            return 'Unable to fetch weather data. Please check the location or try again later.';
        }

        $weatherData = $response->json();
        $temperature = $weatherData['main']['temp'];
        $condition = $weatherData['weather'][0]['main'];

        if ($temperature > 29) {
            $recommendations = "Promote cold drinks and ice cream.";
            $dynamicPricing = "Increase prices for cold drinks by 10%.";
        } elseif ($temperature < 15) {
            $recommendations = "Promote hot drinks and soups.";
            $dynamicPricing = "Increase prices for hot drinks by 15%.";
        } else {
            $recommendations = "Promote balanced meal options.";
            $dynamicPricing = "Keep prices stable.";
        }
        $cities = json_decode(file_get_contents(public_path('data/egypt_cities.json')));

        return [
            'weather' => $weatherData,
            'recommendations' => $recommendations,
            'dynamicPricing' => $dynamicPricing,
            'cities' => $cities
        ];
    }
}
