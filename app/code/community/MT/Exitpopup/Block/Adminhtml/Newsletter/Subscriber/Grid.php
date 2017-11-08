<?php
class MT_Exitpopup_Block_Adminhtml_Newsletter_Subscriber_Grid
    extends Mage_Adminhtml_Block_Newsletter_Subscriber_Grid
{
    protected function _prepareColumns()
    {
        $lastColumn = 'lastname';
        $this->addColumnAfter('exit_popup_coupon_code', array(
            'header'    => Mage::helper('exitpopup')->__('Exit Popup Coupon'),
            'index'     => 'exit_popup_coupon_code',
            'default'   => '---',
        ), $lastColumn);

        parent::_prepareColumns();
        return $this;
    }
}