<?php
namespace AHT\Poll\Model\ResourceModel\Poll;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection{
	protected $_idFieldName = "poll_id";
	protected function _construct(){
		$this->_init("AHT\Poll\Model\Poll","AHT\Poll\Model\ResourceModel\Poll");
	}
}