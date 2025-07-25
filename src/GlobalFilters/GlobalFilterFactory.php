<?php
namespace wirdwird\Filters\GlobalFilters;

use wirdwird\Filters\GlobalFilters\OrGlobalFilter;
use wirdwird\Filters\GlobalFilters\AndGlobalFilter;

/**
 * Factory for global filtering strategies (AND/OR).
 */
class GlobalFilterFactory
{
    public static function create(string $logic)
    {
        return match (strtoupper($logic)) {
            'OR' => new OrGlobalFilter(),
            default => new AndGlobalFilter(),
        };
    }
}
