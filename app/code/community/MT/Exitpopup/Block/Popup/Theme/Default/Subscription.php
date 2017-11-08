<?php
class MT_Exitpopup_Block_Popup_Theme_Default_Subscription
    extends Mage_Core_Block_Template
{

    public function __construct()
    {
        $this->setTemplate('mt/exitpopup/popup/theme/default/subscription.phtml');
    }

    public function getText($key)
    {
        return Mage::getStoreConfig('exitpopup/newsletter_subscription_form/text_'.$key);
    }

    public function getColor($key)
    {
        return $this->getParentBlock()->getColor($key);
    }

}