<?php

namespace App\Helpers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Paginator
{
    public static function simplePaginationDetails(LengthAwarePaginator $collection): array
    {
        return [
            'count' => $collection->total(),
            'per_page' => $collection->perPage(),
            'current_page' => $collection->currentPage(),
            'has_next_page' => $collection->hasMorePages(),
            'has_previous_page' => $collection->previousPageUrl(),
        ];
    }
}
