<?php

use Kirby\Cms\App as Kirby;
use wirdwird\Filters\FilterManager;

@include_once __DIR__ . '/vendor/autoload.php';

Kirby::plugin('wirdwird/filters', [
    'snippets' => [
        'filters' => __DIR__ . '/snippets/filters.php',
    ]
]);

function filter($collection, $filter_values, $filter_definitions, $globalLogic)
{
    return new FilterManager($collection, $filter_values, $filter_definitions, $globalLogic);
}
