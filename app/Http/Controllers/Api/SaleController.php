<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ApiRequest;
use App\Services\SaleService;
use Illuminate\Http\JsonResponse;

class SaleController extends Controller
{
    public function __construct(private SaleService $saleService) {}

    public function get(ApiRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $limit = $validated['limit'] ?? config('app.api_limit', 500);

        $sales = $this->saleService->getPaginatedSales($validated, $limit);

        return response()->json([
            'success' => true,
            'data' => $sales
        ]);
    }
}
