<?php 
namespace AHT\Poll\Block\Widget\Poll;
use \Magento\Framework\View\Element\Template\Context;
use AHT\Poll\Model\PollFactory;
use \AHT\Poll\Model\ResourceModel\Pollanswer\CollectionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface; 
 
class Poll extends Template implements BlockInterface {

    protected $_template = "widget/polls.phtml";
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

    public function getPoll($pollId)
    {
        $poll = $this->_pollFactory->create()->load($pollId)->getData();
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
}