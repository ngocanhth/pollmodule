<?php
namespace AHT\Poll\Observer;

	use Magento\Framework\Event\ObserverInterface;
    use Magento\Framework\App\RequestInterface;
 
    class ChangeDisplayText implements ObserverInterface
    {
        public function execute(\Magento\Framework\Event\Observer $observer) {
            $price=$observer->getPrice("price");
            echo "Đây là sự kiện sau khi add to cart - Giá lấy từ Config trong admin là: ".$price;
        }
    }


