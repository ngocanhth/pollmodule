<?php
namespace AHT\Poll\Model\ResourceModel;
class Poll extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb{
	protected function _construct(){
		$this->_init("poll","poll_id");
	}
}