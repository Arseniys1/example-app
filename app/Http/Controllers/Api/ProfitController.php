<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProfitService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfitController extends Controller
{
    public function __construct(private ProfitService $profitService) {}

    public function get(Request $request): JsonResponse
    {
        $limit = $request->get('limit', 500);

        $profits = $this->profitService->getPaginatedProfits($request->all(), $limit);

        return response()->json([
            'success' => true,
            'data' => $profits
        ]);
    }
}
