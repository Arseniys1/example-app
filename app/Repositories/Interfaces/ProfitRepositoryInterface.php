<?php

namespace App\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface ProfitRepositoryInterface
{
    public function getPaginated(array $filters = [], int $limit = 500): LengthAwarePaginator;
}
