<?php

class MT_Exitpopup_Model_Adminhtml_System_Config_Icon
{
    public function toOptionArray()
    {
        return array(
            array('value' => 'letter', 'label'=>Mage::helper('adminhtml')->__('Letter')),
            array('value' => 'giftcard',   'label'=>Mage::helper('adminhtml')->__('Gift Card')),

        );
    }
}