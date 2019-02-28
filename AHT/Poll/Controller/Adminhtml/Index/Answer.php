<?php
namespace AHT\Poll\Controller\Adminhtml\Index;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
class Answer extends \Magento\Backend\App\Action{
	protected $_resultPageFactory;
	public function __construct(Context $context, PageFactory $pageFactory){
		parent::__construct($context);
		$this->_resultPageFactory=$pageFactory;
	}
	public function execute(){
		$resultPage=$this->_resultPageFactory->create();
		$resultPage->setActiveMenu("AHT_Poll::poll"); 
		$resultPage->getConfig()->getTitle()->prepend(__("Poll Manager"));
		return $resultPage;
	}
}