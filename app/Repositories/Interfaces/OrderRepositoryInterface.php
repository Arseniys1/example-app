<?php

namespace App\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface OrderRepositoryInterface
{
    public function getPaginated(array $filters = [], int $limit = 500): LengthAwarePaginator;
}
