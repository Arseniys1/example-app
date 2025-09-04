<?php

namespace App\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface WarehouseRepositoryInterface
{
    public function getPaginated(array $filters = [], int $page = 1, int $limit = 500): LengthAwarePaginator;
}
