<?php

/* @var $installer Mage_Core_Model_Resource_Setup */

$installer = $this;

$installer->startSetup();

$installer->getConnection()
    ->addColumn(
        $installer->getTable('easytemplate/group'),
        'store_id',
        Varien_Db_Ddl_Table::TYPE_SMALLINT
    );


$installer->endSetup();
