<?php
namespace AHT\Poll\Controller\Adminhtml\Index;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use AHT\Poll\Model\PollFactory;
use AHT\Poll\Model\PollanswerFactory;
use Magento\Framework\Registry; //Để truyền model từ Block sang form
class EditAnswer extends \Magento\Backend\App\Action{
	protected $_resultPageFactory;
	protected $_pollFactory;
	protected $_pollanswerFactory;
	protected $_coreRegistry;
	public function __construct(
					Context $context, 
					PageFactory $pageFactory,
					PollFactory $pollFactory,
					PollanswerFactory $pollanswerFactory,
					Registry $registry){
		parent::__construct($context);
		$this->_resultPageFactory=$pageFactory;
		$this->_pollFactory=$pollFactory;
		$this->_pollanswerFactory=$pollanswerFactory;
		$this->_coreRegistry = $registry;
	}
	public function execute(){
		$pollId=$this->getRequest()->getParam("poll_id");

		$pollModel=$this->_pollFactory->create()->load($pollId);
		$pollAnswerModel=$this->_pollanswerFactory->create();
		if($pollId){
			$title="Add Poll Answer: ".$pollModel->getPollTitle();
		}else{
			$this->messageManager->addError(__("Select a poll to add new answer"));
			return $this->_redirect("*/*/");
		}
		$data=$this->_session->getFormData(true); 
		if(!empty($data)){
			$pollAnswerModel->setData($data);
		}
		$this->_coreRegistry->register("pollanswer",$pollAnswerModel); //Đưa đối tượng model vào registry
		$resultPage=$this->_resultPageFactory->create();
		$resultPage->setActiveMenu("AHT_Poll::poll");
		$resultPage->getConfig()->getTitle()->prepend(__($title));
		return $resultPage;
	}
}