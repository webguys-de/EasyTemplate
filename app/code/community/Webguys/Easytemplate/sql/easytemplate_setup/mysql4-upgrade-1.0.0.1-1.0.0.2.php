<?php

/* @var $installer Mage_Core_Model_Resource_Setup */

$installer = $this;

$installer->startSetup();


$table = $installer->getConnection()
    ->newTable($installer->getTable('easytemplate/template_data_text'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Id')
    ->addColumn('element_id', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ), 'block_id')
    ->addColumn('field', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ), 'field')
    ->addColumn('value', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
    ), 'value')

    /* TODO:
    ->addIndex($installer->getIdxName('poll/poll', array('store_id')),
        array('store_id'))
    ->addForeignKey($installer->getFkName('poll/poll', 'store_id', 'core/store', 'store_id'),
        'store_id', $installer->getTable('core/store'), 'store_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE)
    */
    ->setComment('Template Data Text');
$installer->getConnection()->createTable($table);


$installer->endSetup();

