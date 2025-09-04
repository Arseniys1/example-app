<?php

namespace App\Services;

use App\Repositories\Interfaces\SaleRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class SaleService
{
    public function __construct(
        private SaleRepositoryInterface $saleRepository
    ) {}

    public function getPaginatedSales(array $filters = [], int $limit = 500): LengthAwarePaginator
    {
        return $this->saleRepository->getPaginated($filters, $limit);
    }
}
