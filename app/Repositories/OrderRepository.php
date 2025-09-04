<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Traits\HandlesDateFilters;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderRepository implements OrderRepositoryInterface
{
    use HandlesDateFilters;

    public function getPaginated(array $filters = [], int $page = 0, int $limit = 500): LengthAwarePaginator
    {
        $query = Order::with(['warehouse', 'sale']);

        $query = $this->applyDateFilters($query, $filters);

        return $query->orderBy('created_at', 'desc')->paginate($limit);
    }
}
