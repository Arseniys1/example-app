<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ApiRequest;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService) {}

    public function get(ApiRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $limit = $validated['limit'] ?? 500;

        $orders = $this->orderService->getPaginatedOrders($validated, $limit);

        return response()->json([
            'success' => true,
            'data' => $orders
        ]);
    }
}
