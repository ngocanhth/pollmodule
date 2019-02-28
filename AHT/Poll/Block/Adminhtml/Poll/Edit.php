<?php
namespace AHT\Poll\Block\Adminhtml\Poll;
use Magento\Backend\Block\Widget\Form\Container;
class Edit extends Container{
	protected function _construct(){
		$this->_blockGroup="AHT_Poll";
		$this->_controller="adminhtml_poll";
		$this->_objectId="poll_id";
		parent::_construct();
	}
}
