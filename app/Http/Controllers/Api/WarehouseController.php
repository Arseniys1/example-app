<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\WarehouseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function __construct(private WarehouseService $warehouseService) {}

    public function get(Request $request): JsonResponse
    {
        $limit = $request->get('limit', 500);

        $warehouses = $this->warehouseService->getPaginatedWarehouses($request->all(), $limit);

        return response()->json([
            'success' => true,
            'data' => $warehouses
        ]);
    }
}
