<?php

namespace App\Repositories;

use App\Models\Sale;
use App\Repositories\Interfaces\SaleRepositoryInterface;
use App\Traits\HandlesDateFilters;
use Illuminate\Pagination\LengthAwarePaginator;

class SaleRepository implements SaleRepositoryInterface
{
    use HandlesDateFilters;

    public function getPaginated(array $filters = [], int $page = 0, int $limit = 500): LengthAwarePaginator
    {
        $query = Sale::with(['order', 'warehouse']);

        $query = $this->applyDateFilters($query, $filters);

        return $query->orderBy('created_at', 'desc')->paginate($limit);
    }
}
