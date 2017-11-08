<?php

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$installer->getConnection()
    ->addColumn($installer->getTable('newsletter/subscriber'), 'exit_popup_coupon_code', 'VARCHAR(50)');

$installer->endSetup();