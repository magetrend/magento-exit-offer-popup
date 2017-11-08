<?php

class MT_Exitpopup_Model_Adminhtml_System_Config_Position
{
    public function toOptionArray()
    {
        return array(
            array('value' => 'leftcenter', 'label'=>Mage::helper('adminhtml')->__('Left Center')),
            array('value' => 'rightcenter', 'label'=>Mage::helper('adminhtml')->__('Right Center')),
            array('value' => 'leftbottom', 'label'=>Mage::helper('adminhtml')->__('Left Bottom')),
            array('value' => 'rightbottom', 'label'=>Mage::helper('adminhtml')->__('Right Bottom')),
        );
    }
}