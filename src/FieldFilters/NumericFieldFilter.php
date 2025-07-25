<?php
namespace wirdwird\Filter\FieldFilters;

use Kirby\Cms\Page;

/**
 * Handles numeric field filtering, including range comparisons.
 */
class NumericFieldFilter
{
    public function matches(Page $page, string $field, array $values, string $strategy): bool
    {
        $fieldValue = (float) $page->{$field}()->value();

        if ($strategy === 'range') {
            foreach ($values as $value) {
                if (preg_match('/([<>]=?)(\d+)/', $value, $matches)) {
                    $operator = $matches[1];
                    $num = (float) $matches[2];

                    if ($operator === '>' && $fieldValue <= $num) {
                        return false;
                    }
                    if ($operator === '<' && $fieldValue >= $num) {
                        return false;
                    }
                    if ($operator === '>=' && $fieldValue < $num) {
                        return false;
                    }
                    if ($operator === '<=' && $fieldValue > $num) {
                        return false;
                    }
                }
            }
            return true;
        }

        return in_array((string) $fieldValue, $values, true);
    }
}
