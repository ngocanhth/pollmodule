<?php
namespace AHT\Poll\Controller\Adminhtml\Index;
use Magento\Backend\App\Action\Context;
use AHT\Poll\Model\PollFactory;

class Delete extends \Magento\Backend\App\Action{
	protected $_pollFactory;
	public function __construct(
					Context $context, 
					PollFactory $pollFactory
				){
		parent::__construct($context);
		$this->_pollFactory=$pollFactory;
	}

	public function execute(){
		$id = $this->getRequest()->getParam('id');
		if($id){
			$model=$this->_pollFactory->create();
			$model->load($id);
			if($model->getId()){
				$model->delete();
				$this->messageManager->addSuccess(__("This poll has been deleted"));
				return $this->_redirect('*/*/');
			}else{
				$this->messageManager->addError(__("This poll no longer exists"));
				return $this->_redirect('*/*/');
			}
		}else{
			$this->messageManager->addError(__("We can't find any id to delete"));
			return $this->_redirect('*/*/');
		} 
	}
}

