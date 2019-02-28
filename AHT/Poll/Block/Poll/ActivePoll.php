<?php
namespace AHT\Poll\Block\Poll;
use \Magento\Framework\View\Element\Template\Context;
use AHT\Poll\Model\PollFactory;
use \AHT\Poll\Model\ResourceModel\Pollanswer\CollectionFactory;
class ActivePoll extends \Magento\Framework\View\Element\Template
{
	protected $_pageFactory;
	protected $_pollFactory;
	protected $_pollanswerCollection;
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

    public function getPoll()
    {
    	$poll = $this->_pollFactory->create();
    	return $poll;
    }

       public function getListPollAnswer($pollId)
    {
    	 $collection = $this->_pollanswerCollection->create()->addFieldToFilter('poll_id', $pollId);
       	 return $collection;
    }

       public function getCountPollAnswer($pollId)
    {
    	 $collection = $this->_pollanswerCollection->create()->addFieldToFilter('poll_id', $pollId)->count();
       	 return $collection;
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $this->setTemplate('AHT_Poll::active.phtml');
        return $this;
    }
}

