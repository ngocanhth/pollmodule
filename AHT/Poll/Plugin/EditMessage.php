<?php  
namespace AHT\Poll\Plugin;
class EditMessage extends \Magento\Framework\App\Helper\AbstractHelper{

  public function getConfig($config_path='poll/general/display_text')
  {
    $result = $this->scopeConfig->getValue(
      $config_path,
      \Magento\Store\Model\ScopeInterface::SCOPE_STORE
    );
    if($result=='') $result = "Tin nhắn mặc định khi không nhập trong admin: ";
    return $result;
  }

  public function aftergetSpecifyOptionMessage($subject, $result){
    $message = $this->getConfig().' You need to choose options for your item.';
    return __($message);
  }

}


