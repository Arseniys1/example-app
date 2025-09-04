<?php

namespace App\Repositories;

use App\Models\Warehouse;
use App\Repositories\Interfaces\WarehouseRepositoryInterface;
use App\Traits\HandlesDateFilters;
use Illuminate\Pagination\LengthAwarePaginator;

class WarehouseRepository implements WarehouseRepositoryInterface
{
    use HandlesDateFilters;

    public function getPaginated(array $filters = [], int $limit = 500): LengthAwarePaginator
    {
        $query = Warehouse::query();

        $query = $this->applyDateFilterOnlyCurrentDay($query, $filters);

        return $query->orderBy('created_at', 'desc')->paginate($limit);
    }
}
