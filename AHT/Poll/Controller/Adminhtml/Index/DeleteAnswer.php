<?php
namespace AHT\Poll\Controller\Adminhtml\Index;
use Magento\Backend\App\Action\Context;
use AHT\Poll\Model\PollFactory;
use AHT\Poll\Model\PollAnswerFactory;

class DeleteAnswer extends \Magento\Backend\App\Action{
	protected $_pollFactory;
	protected $_answerFactory;
	public function __construct(
					Context $context, 
					PollFactory $pollFactory,
					PollAnswerFactory $answerFactory
				){
		parent::__construct($context);
		$this->_pollFactory=$pollFactory;
		$this->_answerFactory=$answerFactory;
	}

	public function execute(){
		$id = $this->getRequest()->getParam('answer_id');
		$pollId = $this->getRequest()->getParam('poll_id');
		$pollModel=$this->_pollFactory->create()->load($pollId);
		if($id){
			$model=$this->_answerFactory->create();
			$model->load($id);
			if($model->getId()){

				echo "string";	die();

				$model->delete();
				$this->messageManager->addSuccess(__("This answer has been deleted"));
				return $this->_redirect('*/*/');
			}else{
				$this->messageManager->addError(__("This answer no longer exists"));
				return $this->_redirect('*/*/');
			}
			}else{
				$this->messageManager->addError(__("We can't find any id to delete"));
				return $this->_redirect('*/*/');
			} 
	}
}

