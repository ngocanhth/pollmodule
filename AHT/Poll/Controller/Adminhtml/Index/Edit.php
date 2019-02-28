<?php
namespace AHT\Poll\Controller\Adminhtml\Index;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use AHT\Poll\Model\PollFactory;
use Magento\Framework\Registry; //Để truyền model từ Block sang form
class Edit extends \Magento\Backend\App\Action{
	protected $_resultPageFactory;
	protected $_pollFactory;
	protected $_coreRegistry;
	public function __construct(
					Context $context, 
					PageFactory $pageFactory,
					PollFactory $pollFactory,
					Registry $registry){
		parent::__construct($context);
		$this->_resultPageFactory=$pageFactory;
		$this->_pollFactory=$pollFactory;
		$this->_coreRegistry = $registry;
	}
	public function execute(){
		$pollId=$this->getRequest()->getParam("id"); 
		$model=$this->_pollFactory->create();
		if($pollId){
			$model->load($pollId);
			if(!$model->getId()){
				$this->messageManager->addError(__("This poll no longer exists")); 
				return $this->_redirect("*/*/");
			}
			$title="Edit A Poll: ".$model->getPollTitle();
		}else{
			$title="Add A New Poll";
		}
		$data=$this->_session->getFormData(true); 
		if(!empty($data)){
			$model->setData($data);
		}
		$this->_coreRegistry->register("poll",$model);
		$resultPage=$this->_resultPageFactory->create();
		$resultPage->setActiveMenu("AHT_Poll::poll");
		$resultPage->getConfig()->getTitle()->prepend(__($title));
		return $resultPage;
	}
}