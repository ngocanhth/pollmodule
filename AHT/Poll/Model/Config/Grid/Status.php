<?php
namespace AHT\Poll\Model\Config\Grid;
use Magento\Framework\Data\OptionSourceInterface;
class Status implements OptionSourceInterface{
	public function toOptionArray(){
		$option=[
			[
				"label" => __("Active"),
				"value" => 1
			],
			[
				"label" => __("Closed"),
				"value" => 0
			]
		];
		return $option;
	}
}