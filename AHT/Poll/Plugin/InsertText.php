<?php
namespace AHT\Poll\Plugin;
 
class InsertText extends \Magento\Framework\App\Helper\AbstractHelper{


  public function getConfig($config_path='poll/general/display_text')
  {
    $result = $this->scopeConfig->getValue(
      $config_path,
      \Magento\Store\Model\ScopeInterface::SCOPE_STORE
    );
    if($result=='') $result = "Tin nhắn mặc định nếu không nhập trong config:";
    return $result.' ';
  }


  public function beforeaddSuccessMessage($subject, $message){
    $message = $this->getConfig().$message;
    return $message;
  }

  public function beforeaddNoticeMessage($subject, $message){
    $message = $this->getConfig().$message;
    return $message;
  }

  public function beforeaddWarningMessage($subject, $message){
    $message = $this->getConfig().$message;
    return $message;
  }

  public function beforeaddErrorMessage($subject, $message){
    $message = $this->getConfig().$message;
    return $message;
  }
}
