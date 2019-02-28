<?php
namespace AHT\Poll\Block\Adminhtml\Poll\Editanswer;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry; 
use Magento\Framework\Data\FormFactory;
use AHT\Poll\Model\Config\Status;
class Form extends Generic{
	protected $_pollStatus;
	public function __construct(
						Context $context,
						Registry $registry,
						FormFactory $formFactory,
						Status $status,
						array $data){
		$this->_pollStatus=$status;
		parent::__construct($context,$registry,$formFactory,$data);
	}
	protected function _construct(){
		$this->setId("poll_formanswer");
		$this->setTitle(__("Poll Information"));
		parent::_construct();
	}
	protected function _prepareForm(){
		$model=$this->_coreRegistry->registry("pollanswer");


		$pollId=$this->getRequest()->getParam("poll_id"); 
		$answer_id=$this->getRequest()->getParam("answer_id"); 




		if($pollId){
		$form=$this->_formFactory->create(
				[
					"data" => [
						"id" => "edit_form",	
						"action" => $this->getUrl("poll/index/saveanswer" ,['poll_id' => $pollId,'answer_id' => $answer_id]), 
						"method" => "post",
						"enctype" => "multipart/form-data"
					]
				]
			);
		//Thiết lập các phần tử của form
		$fieldset=$form->addFieldset(
				"base_fieldset", 
				["legend"=>__("Create a new Poll Answer"),"class"=>"fieldset-wide"]
			);

		$fieldset->addField(
				"answer_title",
				"text",
				[
					"name" => "answer_title",
					"label" => __("Poll Answer"),
					"required" => true,
				]
			);
		$fieldset->addField(
				"votes_count",
				"text",
				[
					"name" => "votes_count",
					"label" => __("Votes Count"),
					"required" => true,
				]
			);
}
		$answer = $model->load($answer_id)->getData(); 
		$form->setValues($answer);		
		$form->setHtmlIdPrefix("poll_main_");
		$form->setUseContainer(true);
		$this->setForm($form);
		return parent::_prepareForm();
	}
}