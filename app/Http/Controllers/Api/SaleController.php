<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SaleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function __construct(private SaleService $saleService) {}

    public function get(Request $request): JsonResponse
    {
        $limit = $request->get('limit', 500);

        $sales = $this->saleService->getPaginatedSales($request->all(), $limit);

        return response()->json([
            'success' => true,
            'data' => $sales
        ]);
    }
}
