<?php

class MT_Exitpopup_Model_Adminhtml_System_Config_Content
{
    const CONTENT_TYPE_NEWSLETTER_SUBSCRIPTION_FORM = 'newsletter_subscription_form';
    const CONTENT_TYPE_SOCIAL_BUTTONS = 'social_buttons';
    const CONTENT_TYPE_STATIC_CMS_BLOCK = 'static_cms_block';

    public function toOptionArray()
    {
        return array(
            array('value' => self::CONTENT_TYPE_NEWSLETTER_SUBSCRIPTION_FORM, 'label'=>Mage::helper('adminhtml')->__('Newsletter Subscription Form')),
           // array('value' => self::CONTENT_TYPE_SOCIAL_BUTTONS,   'label'=>Mage::helper('adminhtml')->__('Social Buttons')),
            array('value' => self::CONTENT_TYPE_STATIC_CMS_BLOCK,   'label'=>Mage::helper('adminhtml')->__('Static CMS Block')),
        );
    }
}