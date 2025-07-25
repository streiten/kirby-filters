<?php
namespace wirdwird\Filter\FieldFilters;

use Kirby\Cms\Page;

/**
 * Handles filtering for list fields (e.g., tags, categories).
 */
class ListFieldFilter
{
    public function matches(Page $page, string $field, array $values, string $strategy): bool
    {
        $fieldValues = array_map('trim', explode(',', $page->{$field}()->value() ?? ''));

        if (strtolower($strategy) === 'and') {
            // Check if all filter values exist in the field values
            return count(array_diff($values, $fieldValues)) === 0;
        }

        // OR strategy: Check if ANY filter values exist in the field values
        return !empty(array_intersect($values, $fieldValues));
    }
}
