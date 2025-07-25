<?php
namespace wirdwird\Filter;

/**
 * Utility class for building filter toggle URLs.
 */
class FilterUrlBuilder
{
    public static function generateToggleUrl(
        array $filters,
        string $field,
        $value,
        array $fieldDefinitions
    ): string {
        // Get field type and strategy from definitions, defaulting to 'string' and 'exact'
        $fieldType = $fieldDefinitions[$field]['type'] ?? 'string';
        $strategy = $fieldDefinitions[$field]['strategy'] ?? 'exact';

        $updatedFilters = $filters;

        if ($fieldType === 'bool') {
            // Special handling for boolean fields
            // We use 'true' as string to ensure proper URL encoding
            // Toggle between having ['true'] and removing the filter entirely
            if (!isset($updatedFilters[$field]) || !in_array('true', $updatedFilters[$field], true)) {
                $updatedFilters[$field] = ['true'];
            } else {
                unset($updatedFilters[$field]);
            }
        } else {
            // Handle non-boolean fields based on strategy
            if ($strategy === 'exclusive') {
                // Exclusive strategy: replace all values with the new one (mutually exclusive)
                if (isset($updatedFilters[$field]) && in_array($value, $updatedFilters[$field])) {
                    // If the value is already selected, remove it (toggle off)
                    unset($updatedFilters[$field]);
                } else {
                    // Replace all values with the new one
                    $updatedFilters[$field] = [$value];
                }
            } else {
                // Multi-selection mode (original behavior for 'exact', 'and', etc.)
                // Toggle individual values in multi-select fashion
                $currentValues = $updatedFilters[$field] ?? [];
                if (in_array($value, $currentValues)) {
                    $updatedFilters[$field] = array_diff($currentValues, [$value]);
                } else {
                    $updatedFilters[$field][] = $value;
                }
            }
        }

        // Clean up: remove any empty filter arrays
        foreach ($updatedFilters as $key => $vals) {
            if (empty($vals)) {
                unset($updatedFilters[$key]);
            }
        }

        // Build the final URL with query parameters
        return '/' . self::buildKirbyQueryString($updatedFilters);
    }

    /**
     * Builds a Kirby-style key:value query string from an array
     *
     * @param array $params The parameters to convert
     * @return string The formatted query string
     */
    public static function buildKirbyQueryString(array $params): string
    {
        $parts = [];
        foreach ($params as $key => $values) {
            if (is_array($values)) {
                $parts[] = $key . ':' . implode(',', $values);
            } else {
                $parts[] = $key . ':' . $values;
            }
        }
        return implode('/', $parts);
    }
}
