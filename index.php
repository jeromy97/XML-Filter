<?php
define('APPNAME', 'Filter');
define('FEEDURL', 'https://www.hendersandhazel.nl/productfeed.xml?commercialdescription=true');
define('FEEDNS', 'g');
define('FEEDISPREFIX', true);

require_once 'functions.php';
require_once 'libs/filter.php';

$feed = new SimpleXMLElement(FEEDURL, 0, true);
$items = $feed->channel->item;
$filter = new Filter($items);

// Start filtering from here...

$price_filters = array(
	'max' => null,
	'min' => null
);

if (isset($_GET['min']) && is_numeric($_GET['min'])) {
	$price_filters['min'] = $_GET['min'];
}

if (isset($_GET['max']) && is_numeric($_GET['max'])) {
	$price_filters['max'] = $_GET['max'];
}

$filter->byPrice($price_filters['min'], $price_filters['max']);

if (isset($_GET['brand'])) {
	$filter->byBrand($_GET['brand']);
}

if (isset($_GET['product_type'])) {
	$filter->byProductType($_GET['product_type']);
}

if (isset($_GET['condition'])) {
	$filter->byCondition($_GET['condition']);
}

if (isset($_GET['availability'])) {
	$filter->byAvailability($_GET['availability']);
}

$items = $filter->items;

// Get remaining filter options

$filterOptions = array(
	'brand' => [],
	'product_type' => [],
	'condition' => [],
	'availability' => []
);

foreach ($items as $item) {
	$filterOptions['brand'][] = (string) getProperties($item)->brand;
	$filterOptions['product_type'][] = (string) getProperties($item)->product_type;
	$filterOptions['condition'][] = (string) getProperties($item)->condition;
	$filterOptions['availability'][] = (string) getProperties($item)->availability;
}

$filterOptions['brand'] = array_unique($filterOptions['brand']);
$filterOptions['product_type'] = array_unique($filterOptions['product_type']);
$filterOptions['condition'] = array_unique($filterOptions['condition']);
$filterOptions['availability'] = array_unique($filterOptions['availability']);

sort($filterOptions['brand']);
sort($filterOptions['product_type']);
sort($filterOptions['condition']);
sort($filterOptions['availability']);

// Count items

$count = count($items);

// Limit items

$limit = $_GET['limit'] ?? 10;
$items = array_slice($items, 0, $limit);

// Unset variables not used in view

unset($filter);
unset($feed);
unset($price_filters);

// Load view

include 'views/filter.php';
