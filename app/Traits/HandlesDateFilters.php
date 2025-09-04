<?php

namespace App\Traits;

use Illuminate\Contracts\Database\Query\Builder;

trait HandlesDateFilters
{
    protected function applyDateFilters(Builder $query, array $filters, $dateField = 'created_at'): Builder
    {
        if (!empty($filters['dateFrom'])) {
            $query->where($dateField, '>=', $filters['dateFrom']);
        }

        if (!empty($filters['dateTo'])) {
            $query->where($dateField, '<=', $filters['dateTo']);
        }

        return $query;
    }
}
