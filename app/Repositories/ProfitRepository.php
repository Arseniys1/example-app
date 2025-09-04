<?php

namespace App\Repositories;

use App\Models\Profit;
use App\Repositories\Interfaces\ProfitRepositoryInterface;
use App\Traits\HandlesDateFilters;
use Illuminate\Pagination\LengthAwarePaginator;

class ProfitRepository implements ProfitRepositoryInterface
{
    use HandlesDateFilters;

    public function getPaginated(array $filters = [], int $page = 0, int $limit = 500): LengthAwarePaginator
    {
        $query = Profit::with('sale');

        $query = $this->applyDateFilters($query, $filters);

        return $query->orderBy('created_at', 'desc')->paginate($limit);
    }
}
