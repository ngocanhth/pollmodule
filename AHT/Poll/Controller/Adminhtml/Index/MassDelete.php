<?php
namespace AHT\Poll\Controller\Adminhtml\Index;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter; //Hỗ trợ lấy những option được lựa chọn
use QHOnline\Student\Model\ResourceModel\Student\CollectionFactory;
class MassDelete extends \Magento\Backend\App\Action{
	protected $_filter;
	protected $_collectionFactory;
	public function __construct(Context $context, Filter $filter, CollectionFactory $collection){
		$this->_filter=$filter;
		$this->_collectionFactory = $collection;
		parent::__construct($context);
	}
	public function execute(){
		$collecObject=$this->_collectionFactory->create();
		$collection=$this->_filter->getCollection($collecObject);
		$imageHelper=$this->_objectManager->get("QHOnline\Student\Helper\Image");
		$numberRecord=$collection->getSize();
		foreach($collection as $item){
			$imageHelper->removeImage($item->getAvatar());
			$item->delete();			
		}
		$this->messageManager->addSuccess(__("A total of %1 records have been deleted",$numberRecord));
		return $this->_redirect("*/*/");
	}
}