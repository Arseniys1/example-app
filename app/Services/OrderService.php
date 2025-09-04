<?php

namespace App\Services;

use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderService
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository
    ) {}

    public function getPaginatedOrders(array $filters = [], int $page = 0, int $limit = 500): LengthAwarePaginator
    {
        return $this->orderRepository->getPaginated($filters, $page, $limit);
    }
}
