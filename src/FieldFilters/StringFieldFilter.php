<?php
namespace wirdwird\Filter\FieldFilters;

use Kirby\Cms\Page;

/**
 * Handles filtering for single-string fields.
 */
class StringFieldFilter
{
    public function matches(Page $page, string $field, array $values, string $strategy): bool
    {
        if ($strategy === 'contains') {
            foreach ($values as $value) {
                if (str_contains($page->{$field}()->value() ?? '', $value)) {
                    return true;
                }
            }
            return false;
        }

        return in_array($page->{$field}()->value(), $values, true);
    }
}
