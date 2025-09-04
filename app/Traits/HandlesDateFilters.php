<?php

namespace App\Traits;

use Illuminate\Contracts\Database\Query\Builder;

trait HandlesDateFilters
{
    protected function parseDate(string $date): ?string
    {
        if (empty($date)) {
            return null;
        }

        $formats = [
            'Y-m-d H:i:s',
            'Y-m-d',
        ];

        foreach ($formats as $format) {
            $parsedDate = \DateTime::createFromFormat($format, $date);
            if ($parsedDate !== false) {
                return $parsedDate->format('Y-m-d');
            }
        }

        return null;
    }

    protected function applyDateFilters(Builder $query, array $filters, $dateField = 'created_at'): Builder
    {
        if (!empty($filters['dateFrom'])) {
            $dateFrom = $this->parseDate($filters['dateFrom']);
            if ($dateFrom) {
                $query->where($dateField, '>=', $dateFrom);
            }
        }

        if (!empty($filters['dateTo'])) {
            $dateTo = $this->parseDate($filters['dateTo']);
            if ($dateTo) {
                $query->where($dateField, '<=', $dateTo);
            }
        }

        return $query;
    }
}
