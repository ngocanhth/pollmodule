<?php
namespace AHT\Poll\Block\Adminhtml\Poll;
use Magento\Backend\Block\Template\Context;
use AHT\Poll\Model\PollFactory;
use \AHT\Poll\Model\ResourceModel\Pollanswer\CollectionFactory;
class Answers extends \Magento\Framework\View\Element\Template
{
	protected $_pageFactory;
	protected $_pollFactory;
	protected $_pollanswerCollection;
	protected $_templates;
	public function __construct(
				Context $context, 
				PollFactory $pollFactory,
				CollectionFactory $PollanswerCollection
				){
	parent::__construct($context);
	$this->_pollFactory=$pollFactory;
	$this->_pollanswerCollection=$PollanswerCollection;
}

	 public function showListPoll()
    {
  		$poll = $this->_pollFactory->create();
		$pollCollection = $poll->getCollection();
		return $pollCollection;
    }

     public function getPollId($pollId)
    {
    	$poll = $this->_pollFactory->create()->load($pollId)->getData();

    	return $poll;
    }

       public function getListPollAnswer($pollId)
    {
    	 $collection = $this->_pollanswerCollection->create()->addFieldToFilter('poll_id', $pollId);
       	 return $collection;
    }

}