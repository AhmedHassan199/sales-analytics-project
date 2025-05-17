<?php

namespace App\Http\Controllers;

use App\Services\RecommendationService;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    protected $recommendationService;

    public function __construct(RecommendationService $recommendationService)
    {
        $this->recommendationService = $recommendationService;
    }

    public function getRecommendations()
    {
        $salesData = $this->recommendationService->getSalesData();
        $recommendations = $this->recommendationService->getAIRecommendations($salesData);

        if (is_array($recommendations) && isset($recommendations['error'])) {
            return response()->json($recommendations, 500);
        }

        return response()->json([
            'recommendations' => $recommendations,
            'sales_data' => $salesData,
        ]);
    }
    public function index()
    {
        return view('admin.recomendations.index');
    }
}
