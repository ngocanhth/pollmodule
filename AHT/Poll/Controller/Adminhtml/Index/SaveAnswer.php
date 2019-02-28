<?php
namespace AHT\Poll\Controller\Adminhtml\Index;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use AHT\Poll\Model\PollFactory;
use AHT\Poll\Model\PollAnswerFactory;
use Magento\Framework\Registry;
class SaveAnswer extends \Magento\Backend\App\Action{
	protected $_resultPageFactory;
	protected $_PollFactory;
	protected $_PollanswerFactory;
	protected $_coreRegistry;
	public function __construct(
					Context $context, 
					PageFactory $pageFactory,
					PollFactory $PollFactory,
					PollAnswerFactory $PollanswerFactory,
					Registry $registry){
		parent::__construct($context);
		$this->_resultPageFactory=$pageFactory;
		$this->_PollFactory=$PollFactory;
		$this->_PollanswerFactory=$PollanswerFactory;
		$this->_coreRegistry = $registry;
	}
	public function execute(){
		$request=$this->getRequest();
		if($request->getPost()){
			$answerId=$request->getParam("answer_id");
			$pollId=$request->getParam("poll_id");
			$answerModel=$this->_PollanswerFactory->create();
			$pollModel=$this->_PollFactory->create()->load($pollId);
			$formData=$request->getPostValue();
			$urlRedirect="*/*/addanswer";			
				$listAnswers = $answerModel->getCollection()->addFieldToFilter('poll_id', $pollId);
					$voteTotal=0;
				foreach ($listAnswers as $answer) {
					$voteTotal += $answer["votes_count"];
				}

			$vote_old = 0;
			if($answerId){
				$answerModel->load($answerId);
				$urlRedirect="*/*/editanswer/id/".$answerModel->getId();
				$vote_old = $answerModel->getData("votes_count");
			}

			$votes_count = (int)$formData["votes_count"]; 
			$votes_count_total = (int)$voteTotal - (int)$vote_old + $votes_count;

			$answerModel->addData([
				"poll_id" => $pollId,
				"answer_title" =>$formData["answer_title"],
				"votes_count" =>$votes_count
			]);

			$pollModel->addData([
					"votes_count" => $votes_count_total 
				]);
			$answerModel->save();
			$pollModel->save();
			$this->messageManager->addSuccess(__("The poll answer information has been saved"));
			if($request->getParam("back")){
				return $this->_redirect("*/*/edit", ["id"=>$answerModel->getId(),"_current"=>true]);
			}
			return $this->_redirect("*/*/");
		}
	}
}