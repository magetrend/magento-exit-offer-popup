<?php

class MT_Exitpopup_Model_Observer
{
    public function beforeSaveSubscriber($observer)
    {
        $subscriber = $observer->getEvent()->getSubscriber();
        $modelSubscriber = Mage::getModel('exitpopup/subscriber');

        if (!Mage::getStoreConfig('exitpopup/coupon/isactive') || !$subscriber->isObjectNew()) {
            return;
        }

        $code = $modelSubscriber->getCouponCode();
        if (!empty($code)) {
            $subscriber->setExitPopupCouponCode($code);
        }
    }

}