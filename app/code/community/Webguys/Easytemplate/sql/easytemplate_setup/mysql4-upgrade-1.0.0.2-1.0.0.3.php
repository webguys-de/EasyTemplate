<?php

/* @var $installer Mage_Core_Model_Resource_Setup */

$installer = $this;

$installer->startSetup();


$table = $installer->getConnection()
    ->newTable($installer->getTable('easytemplate/template_data_int'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Id')
    ->addColumn('element_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false,
    ), 'block_id')
    ->addColumn('field', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ), 'field')
    ->addColumn('value', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    ), 'value')

    ->addIndex($installer->getIdxName('easytemplate/template_data_int', array('field')),
        array('field'))
    ->addForeignKey($installer->getFkName('easytemplate/template_data_int', 'element_id', 'easytemplate/template', 'id'),
        'element_id', $installer->getTable('easytemplate/template'), 'id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)

    ->setComment('Template Data Int');
$installer->getConnection()->createTable($table);

$table = $installer->getConnection()
    ->newTable($installer->getTable('easytemplate/template_data_datetime'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Id')
    ->addColumn('element_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false,
    ), 'block_id')
    ->addColumn('field', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ), 'field')
    ->addColumn('value', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
    ), 'value')

    ->addIndex($installer->getIdxName('easytemplate/template_data_datetime', array('field')),
        array('field'))
    ->addForeignKey($installer->getFkName('easytemplate/template_data_datetime', 'element_id', 'easytemplate/template', 'id'),
        'element_id', $installer->getTable('easytemplate/template'), 'id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)

    ->setComment('Template Data Datetime');
$installer->getConnection()->createTable($table);

$table = $installer->getConnection()
    ->newTable($installer->getTable('easytemplate/template_data_decimal'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Id')
    ->addColumn('element_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false,
    ), 'block_id')
    ->addColumn('field', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ), 'field')
    ->addColumn('value', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
    ), 'value')

    ->addIndex($installer->getIdxName('easytemplate/template_data_decimal', array('field')),
        array('field'))
    ->addForeignKey($installer->getFkName('easytemplate/template_data_decimal', 'element_id', 'easytemplate/template', 'id'),
        'element_id', $installer->getTable('easytemplate/template'), 'id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)

    ->setComment('Template Data Decimal');
$installer->getConnection()->createTable($table);


$installer->endSetup();

