<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Query\Builder;

trait HandlesDateFilters
{
    protected function applyDateFilters(Builder $query, array $filters, $dateField = 'created_at'): Builder
    {
        $query->where($dateField, '>=', $filters['dateFrom']);
        $query->where($dateField, '<=', $filters['dateTo']);

        return $query;
    }

    protected function applyDateFilterOnlyCurrentDay(Builder $query, array $filters, $dateField = 'created_at'): Builder
    {
        $date = Carbon::parse($filters['dateFrom']);

        $startOfDay = $date->copy()->startOfDay();
        $endOfDay = $date->copy()->endOfDay();

        $query->whereBetween($dateField, [$startOfDay, $endOfDay]);

        return $query;
    }
}
