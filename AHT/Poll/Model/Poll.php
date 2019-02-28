<?php
namespace AHT\Poll\Model;
class Poll extends \Magento\Framework\Model\AbstractModel{
	protected function _construct(){
		$this->_init("AHT\Poll\Model\ResourceModel\Poll");
	}
}