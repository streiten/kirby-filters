<?php
namespace wirdwird\Filters\FieldFilters;

use wirdwird\Filters\FieldFilters\BooleanFieldFilter;
use wirdwird\Filters\FieldFilters\ListFieldFilter;
use wirdwird\Filters\FieldFilters\NumericFieldFilter;
use wirdwird\Filters\FieldFilters\DateFieldFilter;
use wirdwird\Filters\FieldFilters\StringFieldFilter;

/**
 * Factory for creating field filter logic based on field definitions.
 */
class FieldFilterFactory
{
    protected array $fieldDefinitions;

    public function __construct(array $fieldDefinitions)
    {
        $this->fieldDefinitions = $fieldDefinitions;
    }

    public function matches($page, string $field, array $values): bool
    {
        $fieldType = $this->fieldDefinitions[$field]['type'] ?? 'string';
        $strategy = $this->fieldDefinitions[$field]['strategy'] ?? 'exact';

        return match ($fieldType) {
            'bool' => (new BooleanFieldFilter())->matches($page, $field, $values),
            'list' => (new ListFieldFilter())->matches($page, $field, $values, $strategy),
            'number' => (new NumericFieldFilter())->matches($page, $field, $values, $strategy),
            // 'date' => (new DateFieldFilter())->matches($page, $field, $values, $strategy),
            default => (new StringFieldFilter())->matches($page, $field, $values, $strategy),
        };
    }

    public function getFieldDefinitions(): array
    {
        return $this->fieldDefinitions;
    }
}
