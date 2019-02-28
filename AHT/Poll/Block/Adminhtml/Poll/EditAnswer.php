<?php
namespace AHT\Poll\Block\Adminhtml\Poll;
use Magento\Backend\Block\Widget\Form\Container;
class EditAnswer extends Container{
	protected function _construct(){
		$this->_blockGroup="AHT_Poll";
		$this->_controller="adminhtml_poll";
		$this->_objectId="answer_id";
		$this->_mode="Editanswer";
		parent::_construct();
		$this->buttonList->update("save", "label",__("Save Answer"));
	}

	public function abc(){
		return __("abbcscs");
	}
}