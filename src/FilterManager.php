<?php
namespace wirdwird\Filter;

use Kirby\Cms\Collection;
use wirdwird\Filter\FieldFilters\FieldFilterFactory;
use wirdwird\Filter\GlobalFilters\GlobalFilterFactory;
use wirdwird\Filter\FilterUrlBuilder;

/**
 * Manages filtering operations on a Kirby page collection.
 */
class FilterManager
{
    protected Collection $collection;
    protected array $filters;
    protected $fieldFilter;
    protected $globalFilter;

    public function __construct(
        Collection $collection,
        array $filters,
        array $fieldDefinitions,
        string $globalLogic,
    ) {
        $this->collection = $collection;
        $this->fieldFilter = new FieldFilterFactory($fieldDefinitions);
        $this->globalFilter = GlobalFilterFactory::create($globalLogic);
        $this->filters = $this->sanitizeFilters($filters);
    }

    protected function sanitizeFilters($filters)
    {
        $formattedFilters = [];
        $fieldDefinitions = $this->fieldFilter->getFieldDefinitions();

        foreach ($filters as $field => $values) {
            // Only process fields that exist in field definitions
            if (isset($fieldDefinitions[$field])) {
                $formattedFilters[$field] = is_array($values) ? $values : explode(',', $values);
            }
        }
        return $formattedFilters;
    }

    /**
     * Returns the filtered collection of pages.
     */
    public function getFilteredCollection(): Collection
    {
        return $this->collection->filter(function ($page) {
            $fieldResults = [];

            foreach ($this->filters as $field => $values) {
                if (isset($this->filters[$field])) {
                    $fieldResults[] = $this->fieldFilter->matches($page, $field, $values);
                }
            }

            return $this->globalFilter->combine($fieldResults);
        });
    }

    /**
     * Generates filter options with active states and toggle URLs.
     */
    public function getFilterOptions(): array
    {
        $filterOptions = [];

        foreach ($this->fieldFilter->getFieldDefinitions() as $field => $definition) {
            $filterOptions[$field] = [
                'name' => $definition['name'],
                'items' => []
            ];

            // Handle bool fields differently
            if ($definition['type'] === 'bool') {
                $filterOptions[$field]['items'] = [[
                    'value' => true,
                    'active' => isset($this->filters[$field]) && in_array(true, $this->filters[$field]),
                    'url' => FilterUrlBuilder::generateToggleUrl(
                        $this->filters,
                        $field,
                        true,
                        $this->fieldFilter->getFieldDefinitions()
                    ),
                ]];
                continue;
            }

            // Handle other field types
            // Use filters values if provided, otherwise extract from collection
            if (isset($definition['options'])) {
                $allValues = $definition['options'];
            } else {
                $allValues = $this->collection->pluck($field, ',', true);
            }

            if ($allValues instanceof \Kirby\Cms\Pages) {
                $allValues = $allValues->pluck('title');
            }

            $filterOptions[$field]['items'] = array_map(function ($value) use ($field) {
                $haystack = isset($this->filters[$field]) ? $this->filters[$field] : [];
                return [
                    'value' => $value,
                    'active' => in_array($value, $haystack),
                    'url' => FilterUrlBuilder::generateToggleUrl(
                        $this->filters,
                        $field,
                        $value,
                        $this->fieldFilter->getFieldDefinitions()
                    ),
                ];
            }, $allValues);
        }

        return [ 'hasActive' => !empty($this->filters), 'options' => $filterOptions ];
    }
}
