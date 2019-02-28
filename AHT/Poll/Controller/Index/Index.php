<?php
namespace AHT\Poll\Controller\Index;
 use Magento\Catalog\Model\ProductFactory;
class Index extends \Magento\Framework\App\Action\Action
{
	protected $_helperData;
	protected $_product;
	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		ProductFactory $product,
		\AHT\Poll\Helper\Data $helperData
	)
	{
		$this->_helperData = $helperData;
		  $this->_product = $product;
		return parent::__construct($context);
	}

	public function execute()
	{

		$price = $this->_helperData->getGeneralConfig('display_price');
		$product =  $this->_product->create();
        $data = new \Magento\Framework\DataObject(array("price" => $price, "product" => $product));
        $this->_eventManager->dispatch('checkout_cart_product_add_after', ['price' =>  $data]);
        exit;
	}

}

