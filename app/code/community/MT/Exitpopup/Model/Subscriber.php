<?php

class MT_Exitpopup_Model_Subscriber
{
    const XML_PATH_EMAIL_ATTACHMENT = 'exitpopup/email/attachment';

    public function getCouponCode()
    {
        $rule = Mage::getModel('salesrule/rule');
        $rule->load(Mage::getStoreConfig('exitpopup/coupon/roleid'));
        if (!$rule->getId()) {
            return;
        }

        if ($rule->getUseAutoGeneration() == 1) {
            $code = $this->generateCouponCode($rule);
        } else {
            $code = $rule->getCouponCode();
        }

        return $code;
    }

    protected function generateCouponCode($rule)
    {
        $massGenerator = $rule->getCouponMassGenerator();
        $massGenerator->setData(array(
            'rule_id' => Mage::getStoreConfig('exitpopup/coupon/roleid'),
            'qty' => 1,
            'length' => Mage::getStoreConfig('exitpopup/coupon/length'),
            'format' => Mage::getStoreConfig('exitpopup/coupon/format'),
            'prefix' => Mage::getStoreConfig('exitpopup/coupon/prefix'),
            'suffix' => Mage::getStoreConfig('exitpopup/coupon/suffix'),
            'dash' => Mage::getStoreConfig('exitpopup/coupon/dash'),
            'uses_per_coupon' => 1,
            'uses_per_customer' => 1
        ));
        $massGenerator->generatePool();
        $latestCoupon = max($rule->getCoupons());

        return $latestCoupon->getCode();
    }
}