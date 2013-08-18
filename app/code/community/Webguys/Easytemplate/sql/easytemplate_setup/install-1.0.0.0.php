<?php

/* @var $installer Mage_Core_Model_Resource_Setup */

$installer = $this;

$installer->startSetup();


$table = $installer->getConnection()
    ->newTable($installer->getTable('easytemplate/template'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Id')
    ->addColumn('group_id', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ), 'group_id')
    ->addColumn('code', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ), 'code')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ), 'name')
    ->addColumn('active', Varien_Db_Ddl_Table::TYPE_SMALLINT, 255, array(
    ), 'active')
    ->addColumn('position', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    ), 'position')
    ->addColumn('valid_from', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
    ), 'valid_from')
    ->addColumn('valid_to', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
    ), 'valid_to')

    /* TODO:
    ->addIndex($installer->getIdxName('poll/poll', array('store_id')),
        array('store_id'))
    ->addForeignKey($installer->getFkName('poll/poll', 'store_id', 'core/store', 'store_id'),
        'store_id', $installer->getTable('core/store'), 'store_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE)
    */
    ->setComment('Template');
$installer->getConnection()->createTable($table);

// --------------------------------------------------------------------

$table = $installer->getConnection()
    ->newTable($installer->getTable('easytemplate/group'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Id')
    ->addColumn('entity_type', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ), 'entity_type')
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    ), 'entity_id')

    /* TODO:
    ->addIndex($installer->getIdxName('poll/poll', array('store_id')),
        array('store_id'))
    ->addForeignKey($installer->getFkName('poll/poll', 'store_id', 'core/store', 'store_id'),
        'store_id', $installer->getTable('core/store'), 'store_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE)
    */
    ->setComment('Templategroup');
$installer->getConnection()->createTable($table);

// --------------------------------------------------------------------

$table = $installer->getConnection()
    ->newTable($installer->getTable('easytemplate/template_data_varchar'))
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
    ->addColumn('value', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ), 'value')

    /* TODO:
    ->addIndex($installer->getIdxName('poll/poll', array('store_id')),
        array('store_id'))
    ->addForeignKey($installer->getFkName('poll/poll', 'store_id', 'core/store', 'store_id'),
        'store_id', $installer->getTable('core/store'), 'store_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE)
    */
    ->setComment('Template Data Varchar');
$installer->getConnection()->createTable($table);


$installer->endSetup();

