<?php
namespace wirdwird\Filters\GlobalFilters;

/**
 * Implements global filtering using OR logic.
 * A page is included if at least one individual field filter condition is met.
 */
class OrGlobalFilter
{
    /**
     * Combine individual field results using OR logic.
     *
     * @param array $fieldResults Array of boolean values from field filters.
     * @return bool True if at least one field result is true; otherwise, false.
     */
    public function combine(array $fieldResults): bool
    {
        return in_array(true, $fieldResults, true);
    }
}
