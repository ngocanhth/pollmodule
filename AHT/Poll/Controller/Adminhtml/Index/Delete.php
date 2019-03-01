<?php
namespace AHT\Poll\Controller\Adminhtml\Index;
use Magento\Backend\App\Action\Context;
use AHT\Poll\Model\PollAnswerFactory;
use AHT\Poll\Model\PollFactory;

class Delete extends \Magento\Backend\App\Action{
	protected $_pollFactory;
	protected $_answerFactory;
	public function __construct(
					Context $context, 
					PollAnswerFactory $answerFactory,
					PollFactory $pollFactory
				){
		parent::__construct($context);
		$this->_answerFactory=$answerFactory;
		$this->_pollFactory=$pollFactory;
	}

	public function execute(){
		$id = $this->getRequest()->getParam('id');
		if($id){
			$model=$this->_pollFactory->create();
			$answerModel=$this->_answerFactory->create()->getCollection()->addFieldToFilter("poll_id",$id);
			foreach ($answerModel as $answer) {
				$answer->delete();
			}
			
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

