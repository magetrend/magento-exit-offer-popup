<?php

class MT_Exitpopup_Model_Adminhtml_System_Config_Cms
{
    protected $_options;

    public function toOptionArray()
    {
        if (!$this->_options) {
            $this->_options = Mage::getResourceModel('cms/block_collection')
                ->load()
                ->toOptionArray();
        }
        return $this->_options;
    }
}