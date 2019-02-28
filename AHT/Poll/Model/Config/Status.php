<?php
namespace AHT\Poll\Model\Config;
use Magento\Framework\Option\ArrayInterface;
class Status implements ArrayInterface{
	const ENABLED =1;
	const DISABLED = 0;

	public function toOptionArray(){
		return [
			self::ENABLED => __("Active"),
			self::DISABLED => __("Close")
		];
	}
}