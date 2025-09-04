<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ApiRequest;
use App\Services\ProfitService;
use Illuminate\Http\JsonResponse;

class ProfitController extends Controller
{
    public function __construct(private ProfitService $profitService) {}

    public function get(ApiRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $limit = $validated['limit'] ?? config('app.api_limit', 500);

        $profits = $this->profitService->getPaginatedProfits($validated, $limit);

        return response()->json([
            'success' => true,
            'data' => $profits
        ]);
    }
}
