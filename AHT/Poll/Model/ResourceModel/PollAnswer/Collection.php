<?php
namespace AHT\Poll\Model\ResourceModel\PollAnswer;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection{
	protected $_idFieldName = "answer_id";
	protected function _construct(){
		$this->_init("AHT\Poll\Model\Pollanswer","AHT\Poll\Model\ResourceModel\PollAnswer");
	}
}