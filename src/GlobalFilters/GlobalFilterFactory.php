<?php
namespace wirdwird\Filter\GlobalFilters;

use wirdwird\Filter\GlobalFilters\OrGlobalFilter;
use wirdwird\Filter\GlobalFilters\AndGlobalFilter;

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
