<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\WarehousesApiRequest;
use App\Services\WarehouseService;
use Illuminate\Http\JsonResponse;

class WarehouseController extends Controller
{
    public function __construct(private WarehouseService $warehouseService) {}

    public function get(WarehousesApiRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $limit = $validated['limit'] ?? 500;

        $warehouses = $this->warehouseService->getPaginatedWarehouses($validated, $limit);

        return response()->json([
            'success' => true,
            'data' => $warehouses
        ]);
    }
}
