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
			$answerModel=$this->_answerFactory->create();
		
			$listAnswers = $answerModel->getCollection()->addFieldToFilter('poll_id', $pollId);
					$voteTotal=0;
				foreach ($listAnswers as $answer) {
					$voteTotal += $answer["votes_count"];
				}

		//		var_dump($voteTotal);die();
				$answerModel->load($id);
				$vote_old = $answerModel->getData("votes_count");
	//var_dump($vote_old);die();
				$votes_count_total = (int)$voteTotal - (int)$vote_old;
//	var_dump($votes_count_total);die();
				$pollModel->addData([
					"votes_count" => $votes_count_total 
				]);

				$pollModel->save();



		
			if($answerModel->getId()){
				$answerModel->delete();

				

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

