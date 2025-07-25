<?php
namespace wirdwird\Filter\GlobalFilters;

/**
 * Implements global filtering using AND logic.
 * A page is included only if all individual field filter conditions are met.
 */
class AndGlobalFilter
{
    /**
     * Combine individual field results using AND logic.
     *
     * @param array $fieldResults Array of boolean values from field filters.
     * @return bool True if all field results are true; otherwise, false.
     */
    public function combine(array $fieldResults): bool
    {
        return !in_array(false, $fieldResults, true);
    }
}
