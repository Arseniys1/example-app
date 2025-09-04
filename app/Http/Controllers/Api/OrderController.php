<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService) {}

    public function get(Request $request): JsonResponse
    {
        $page = $request->get('limit', 0);
        $limit = $request->get('limit', 500);

        $orders = $this->orderService->getPaginatedOrders($request->all(), $page, $limit);

        return response()->json([
            'success' => true,
            'data' => $orders
        ]);
    }
}
