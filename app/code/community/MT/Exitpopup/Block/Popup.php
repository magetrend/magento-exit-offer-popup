<?php
class MT_Exitpopup_Block_Popup extends Mage_Core_Block_Template
{

    public function getCookieName()
    {
        return Mage::getStoreConfig('exitpopup/popup/cookiename');
    }

    public function getCookieLifeTime()
    {
        if (Mage::getStoreConfig('exitpopup/general/dev'))
            return 0.00001;
        return Mage::getStoreConfig('exitpopup/popup/cookielifetime');
    }

    public function isActivePopUp()
    {
        return Mage::getStoreConfig('exitpopup/popup/isactive');
    }

    public function getTheme()
    {
        return Mage::getStoreConfig('exitpopup/popup/theme');
    }

    public function getText()
    {
        return Mage::getStoreConfig('exitpopup/popup/message');
    }

    public function getPopupContentHtml()
    {
        return $this->getChildHtml('popup_theme_'.$this->getTheme());
    }

    public function getConfig()
    {
        $baseUrl = str_replace(array('http:', 'https:'), '', Mage::getUrl(''));
        $config = array(
            'subscriptionProcessUrl' => str_replace(array('http:', 'https:'), '', Mage::getUrl('exitpopup/subscriber/new/')),
            'translate' => Mage::getStoreConfig('exitpopup/translate'),
            'baseUrl' => $baseUrl,
            'layerClose' => Mage::getStoreConfig('exitpopup/popup/layer_close')?true:false,
        );

        if ($this->getButtonIsActive() && $this->getButtonUsage() == 0) {
            $config['autoStart'] = false;
        }

        if ($this->getCookieName() != '') {
            $config['cookieName'] = $this->getCookieName();
        }

        if ($this->getShowInLast() != '') {
            $config['showInLast'] = $this->getShowInLast();
        }

        if (is_numeric($this->getCookieLifeTime())) {
            $config['cookieLifeTime'] = $this->getCookieLifeTime();
        }

        return $config;
    }

    public function getConfigJs()
    {
        return json_encode($this->getConfig());
    }

    public function getContentType()
    {
        return Mage::getStoreConfig('exitpopup/popup/content');
    }

    public function getShowInLast()
    {
        return Mage::getStoreConfig('exitpopup/popup/showinlast');
    }

    public function getStaticBlockHtml()
    {
        $id = Mage::getStoreConfig('exitpopup/static_cms_block/id');
        if (!is_numeric($id)) {
            return '';
        }

        return Mage::app()->getLayout()->createBlock('cms/block')->setBlockId($id)->toHtml();
    }

}

