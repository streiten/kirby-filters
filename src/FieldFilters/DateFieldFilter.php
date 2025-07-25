<?php
namespace wirdwird\Filters\FieldFilters;

use Kirby\Cms\Page;

/**
 * Handles filtering for date fields.
 */
class DateFieldFilter
{
    public function matches(Page $page, string $field, array $values, string $strategy): bool
    {
        $timestamp = strtotime($page->{$field}()->value());

        foreach ($values as $value) {
            if (preg_match('/(before|after):(\d{4}-\d{2}-\d{2})/', $value, $matches)) {
                $comparison = $matches[1];
                $compareDate = strtotime($matches[2]);

                if ($comparison === 'before' && $timestamp >= $compareDate) {
                    return false;
                }
                if ($comparison === 'after' && $timestamp <= $compareDate) {
                    return false;
                }
            }
        }

        return in_array(date('Y-m-d', $timestamp), $values, true);
    }
}
