<?php
class MT_Exitpopup_Block_Popup_Theme_Default extends Mage_Core_Block_Template
{

    public function __construct()
    {
        $this->setTemplate('mt/exitpopup/popup/theme/default.phtml');
    }

    public function getContentType()
    {
        return $this->getParentBlock()->getContentType();
    }

    public function getColor($key)
    {
        return '#'.str_replace('#', '', Mage::getStoreConfig('exitpopup/theme_default/color_'.$key));
    }


}