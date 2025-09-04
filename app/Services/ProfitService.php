<?php

namespace App\Services;

use App\Repositories\Interfaces\ProfitRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ProfitService
{
    public function __construct(
        private ProfitRepositoryInterface $profitRepository
    ) {}

    public function getPaginatedProfits(array $filters = [], int $page = 1, int $limit = 500): LengthAwarePaginator
    {
        return $this->profitRepository->getPaginated($filters, $page, $limit);
    }
}
