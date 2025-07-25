# Kirby Filters

Filtering Plugin for Kirby CMS that lets you create dynamic, url parameter based filters for collections. It supports multiple field types, strategies, and single/multi-selection modes. It generates toggling filter options with active states easing building the interface.

## Setup

### Requirements
TBD

### Example Controller
```php
$collection = kirby()->collection('notes');
$filter_values = params() ?? [];
$filter_definitions = [
    'tags' => [
        'name' => 'Tags', // passed to template e.g. for use as label
        'type' => 'list', // comma separated string
        'strategy' => 'AND', // match all (AND) or any (OR)
        // Optional, fixe filter values for predefined filter options otherwise plucked from field.
        // 'options' => ['Tree', 'Forest', 'Stars', 'Universe', 'Moon', 'Water']
    ],
    'cats' => [
        'name' => 'Categories',
        'type' => 'list',
        'strategy' => 'OR'
    ],
    'year' => [
        'name' => 'Release Year',
        'type' => 'number',
        'strategy' => 'exclusive' // single selection
    ],
    'award' => [
        'name' => 'Award',
        'type' => 'bool',
    ],
    'other' => [
        'name' => 'Other',
        'type' => 'string',
        'strategy' => 'contains',
        'options' => ['1', '23']
    ]
];

$globalStrategy = 'AND';

$filterManager = filter($collection, $filter_values, $filter_definitions, $globalStrategy);

return [
    'options' => $filterManager->getFilterOptions(),
    'notes' => $filterManager->getFilteredCollection()->paginate(6)
];
```

## Snippet
Default snippet, which you most likely would like to override.  
```
snippet('filters',  $filterOptions);
```

### Filter Definitions

Each field you would like to filter requires a configuration array:

```php
$fields = [
    'fieldName' => [
        'name' => 'Tags',              // Optional: Human-readable name, passed to template
        'type' => 'list',              // Required: Field type
        'strategy' => 'AND',           // Optional: Filtering strategy, defaults to TBD
        'options' => ['A','B','C']     // Optional: Predefined options instead of plucking from field.
    ]
];
```

### Filter Options

Filter values are plucked from the field unless explicitly configured in filter definition.

**Considerations**  
* show options even when no items currently have those values  
* control which options are available to users.  
* order of Options. 

### Global Logic

Controls how multiple field filters are combined:

- **`'AND'`**: All field filters must match (default)
- **`'OR'`**: Any field filter can match

## Methods

### `getFilteredCollection()`

Returns the filtered subset of pages based on current filter parameters.

**Returns:**  
`Kirby\Cms\Collection`

### `getFilterOptions()`

Generates filter options with active states and toggle URLs for building the filter interface.

**Returns:**  
```php
[   
    'hasActive' => bool, 
    'options' => [  
        'fieldName' => [  
            'name' => 'Name'  
            'items' => [  
                'value' => 'optionValue',  
                'active' => bool,
                'url' => string
            ],  
            // ... more options  
        ]  
    ]  
]  
```

## Questions
Post an issue or [get in touch](mailto:dev@alextolar.net).

## Contributing
Contributions and feedback are always welcome!
