<?php

class MT_Exitpopup_Model_Adminhtml_System_Config_Newsletterpopuptheme
{
    public function toOptionArray()
    {
        return array(
            array('value' => 'default', 'label'=>Mage::helper('adminhtml')->__('Default')),
        );
    }
}