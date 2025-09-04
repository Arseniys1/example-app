<?php

namespace App\Services;

use App\Repositories\Interfaces\WarehouseRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class WarehouseService
{
    public function __construct(
        private WarehouseRepositoryInterface $warehouseRepository
    ) {}

    public function getPaginatedWarehouses(array $filters = [], int $page = 0, int $limit = 500): LengthAwarePaginator
    {
        return $this->warehouseRepository->getPaginated($filters, $page, $limit);
    }
}
