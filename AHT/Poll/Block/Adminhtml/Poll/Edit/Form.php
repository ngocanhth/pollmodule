<?php
namespace AHT\Poll\Block\Adminhtml\Poll\Edit;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry; //Class Generic có sẵn các đối số làm việc với registry
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
		$this->setId("poll_form");
		$this->setTitle(__("Poll Information"));
		parent::_construct();
	}
	protected function _prepareForm(){
		$model=$this->_coreRegistry->registry("poll");
		$form=$this->_formFactory->create(
				[
					"data" => [
						"id" => "edit_form",
						"action" => $this->getData("action"), 
						"method" => "post",
						"enctype" => "multipart/form-data"
					]
				]
			);
		//Thiết lập các phần tử của form
		$fieldset=$form->addFieldset(
				"base_fieldset", //id của fieldset
				["legend"=>__("Create a new Poll Question"),"class"=>"fieldset-wide"]
			);

		if($model->getId()){ 
			$fieldset->addField(
					"poll_id",
					"hidden",
					["name" => "poll_id"]
				);
		}
		$fieldset->addField(
				"poll_title", 
				"text",
				[
					"name" => "poll_title", 
					"label" => __("Poll Question"),
					"required" => true,
				]
			);

		$fieldset->addField(
				"status",
				"select",
				[
					"name" => "status",
					"label" => __("Status"),
					"required" => true,
					"options" => $this->_pollStatus->toOptionArray()
				]
			);	

		$data=$model->getData(); 
		$form->setValues($data);
		$form->setHtmlIdPrefix("poll_main_");
		$form->setUseContainer(true);
		$this->setForm($form);
		return parent::_prepareForm();
	}
}