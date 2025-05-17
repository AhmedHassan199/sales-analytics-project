<?php

namespace App\Http\Controllers;

use App\Services\RecommendationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherRecommendationController extends Controller
{
    protected $recommendationService;

    public function __construct(RecommendationService $recommendationService)
    {
        $this->recommendationService = $recommendationService;
    }

    public function show(Request $request)
    {

        $location = $request->get('location', 'Cairo');

        $data = $this->recommendationService->getWeatherRecommendations($location);
        if (is_string($data)) {
            return view('admin.recomendations.weather', ['error' => $data]);
        }

        return view('admin.recomendations.weather', $data);
    }
}
