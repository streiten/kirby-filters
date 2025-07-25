<?php
namespace wirdwird\Filters\FieldFilters;

use Kirby\Cms\Page;

/**
 * Handles boolean field filtering.
 */
class BooleanFieldFilter
{
    public function matches(Page $page, string $field, array $values): bool
    {
        return in_array((string) $page->{$field}()->value(), array_map('strtolower', $values), true);
    }
}
