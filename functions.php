<?php defined('APPNAME') or exit ('Forbidden');

function getProperties($item)
{
	return $item->children(FEEDNS, FEEDISPREFIX);
}

function formatPrice($value)
{
	return '€ ' . number_format( (float) $value, 2, ',', '.');
}