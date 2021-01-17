<?php defined('APPNAME') or exit ('Forbidden');

/**
 * The filter class
 */
class Filter
{
	public $items;
	
	function __construct($items)
	{
		$itemsArray = [];
		
		foreach ($items as $item) {
			$itemsArray[] = $item;
		}
		
		$this->items = $itemsArray;
	}
	
	public function byPrice($min = null, $max = null)
	{
		if ($min === null && $max === null)
			return;
		
		$items = $this->items;
		if ($min !== null) {
			$items = array_filter($items, function($item) use($min){
				return (float) getProperties($item)->price >= $min;
			});
		}
		
		if ($max !== null) {
			$items = array_filter($items, function($item) use($max){
				return (float) getProperties($item)->price <= $max;
			});
		}
		
		$this->items = $items;
	}
	
	public function byBrand($brand = [], $prop = "brand")
	{
		if (empty($brand))
			return;
		
		if (is_scalar($brand))
			$brand = [$brand];
		
		$items = $this->items;
		
		$items = array_filter($items, function($item) use($brand, $prop){
			return in_array(getProperties($item)->{$prop}, $brand);
		});
		
		$this->items = $items;
	}
	
	/**
	 * Same as byBrand() but using the "product_type" property.
	 */
	public function byProductType($product_type = [])
	{
		$this->byBrand($product_type, "product_type");
	}
	
	/**
	 * Same as byBrand() but using the "condition" property.
	 */
	public function byCondition($condition = [])
	{
		$this->byBrand($condition, "condition");
	}
	
	/**
	 * Same as byBrand() but using the "availability" property.
	 */
	public function byAvailability($availability = [])
	{
		$this->byBrand($availability, "availability");
	}
}