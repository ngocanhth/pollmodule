<?php
namespace AHT\Poll\Controller\Adminhtml\Index;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use AHT\Poll\Model\PollFactory;
use Magento\Framework\Registry;
class Save extends \Magento\Backend\App\Action{
	protected $_resultPageFactory;
	protected $_pollFactory;
	protected $_coreRegistry;
	const ADMIN_RESOURCE = "AHT_Poll::poll_save";
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
		$request=$this->getRequest();
		if($request->getPost()){
			$pollModel=$this->_pollFactory->create();
			$pollId=$request->getParam("poll_id"); 
			$formData=$request->getPostValue(); 
			$urlRedirect="*/*/add";
			if($pollId){
				$pollModel->load($pollId);
				$urlRedirect="*/*/edit/id/".$pollModel->getId();
			}
			$pollModel->setData($formData); 
			$pollModel->save();
			$this->messageManager->addSuccess(__("The poll question information has been saved"));
			if($request->getParam("back")){
				return $this->_redirect("*/*/edit", ["id"=>$pollModel->getId(),"_current"=>true]);
			}
			return $this->_redirect("*/*/");
		}

	}
}