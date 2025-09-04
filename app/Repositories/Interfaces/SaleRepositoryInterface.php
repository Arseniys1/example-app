<?php

namespace App\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface SaleRepositoryInterface
{
    public function getPaginated(array $filters = [], int $page = 0, int $limit = 500): LengthAwarePaginator;
}
