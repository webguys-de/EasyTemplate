<?php

/* @var $installer Mage_Core_Model_Resource_Setup */

$installer = $this;

$installer->startSetup();


$table = $installer->getConnection()
    ->newTable($installer->getTable('easytemplate/group'))
    ->addColumn(
        'id',
        Varien_Db_Ddl_Table::TYPE_SMALLINT,
        6,
        array(
            'identity' => true,
            'nullable' => false,
            'primary' => true,
        ),
        'Id'
    )
    ->addColumn(
        'entity_type',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        255,
        array(
            'nullable' => false,
        ),
        'entity_type'
    )
    ->addColumn(
        'entity_id',
        Varien_Db_Ddl_Table::TYPE_SMALLINT,
        6,
        array(
            'unsigned' => true,
            'nullable' => false,
        ),
        'entity_id'
    )

    ->setComment('Templategroup');
$installer->getConnection()->createTable($table);

// --------------------------------------------------------------------

$table = $installer->getConnection()
    ->newTable($installer->getTable('easytemplate/template'))
    ->addColumn(
        'id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary' => true,
        ),
        'Id'
    )
    ->addColumn(
        'group_id',
        Varien_Db_Ddl_Table::TYPE_SMALLINT,
        6,
        array(
            'nullable' => false,
        ),
        'group_id'
    )
    ->addColumn(
        'code',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        255,
        array(
            'nullable' => false,
        ),
        'code'
    )
    ->addColumn(
        'name',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        255,
        array(
            'nullable' => false,
        ),
        'name'
    )
    ->addColumn(
        'active',
        Varien_Db_Ddl_Table::TYPE_SMALLINT,
        6,
        array(
            'nullable' => false,
            'default' => 0,
        ),
        'active'
    )
    ->addColumn(
        'position',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        10,
        array(
            'nullable' => false,
            'unsigned' => true,
        ),
        'position'
    )
    ->addColumn(
        'valid_from',
        Varien_Db_Ddl_Table::TYPE_DATETIME,
        null,
        array(),
        'valid_from'
    )
    ->addColumn(
        'valid_to',
        Varien_Db_Ddl_Table::TYPE_DATETIME,
        null,
        array(),
        'valid_to'
    )

    ->addIndex(
        $installer->getIdxName('easytemplate/template', array('code')),
        array('code')
    )
    ->addForeignKey(
        $installer->getFkName('easytemplate/template', 'group_id', 'easytemplate/group', 'id'),
        'group_id',
        $installer->getTable('easytemplate/group'),
        'id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )

    ->setComment('Template');
$installer->getConnection()->createTable($table);

// --------------------------------------------------------------------

$installer->endSetup();
