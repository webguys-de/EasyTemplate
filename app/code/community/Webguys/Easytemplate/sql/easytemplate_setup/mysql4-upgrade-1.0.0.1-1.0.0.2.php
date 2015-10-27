<?php

/* @var $installer Mage_Core_Model_Resource_Setup */

$installer = $this;

$installer->startSetup();

/* ---------------- template_data_varchar */

$table = $installer->getConnection()
    ->newTable($installer->getTable('easytemplate/template_data_varchar'))
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
        'template_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
            'unsigned' => true,
            'nullable' => false,
        ),
        'block_id'
    )
    ->addColumn(
        'field',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        255,
        array(
            'nullable' => false,
        ),
        'field'
    )
    ->addColumn(
        'value',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        255,
        array(),
        'value'
    )

    ->addIndex(
        $installer->getIdxName('easytemplate/template_data_varchar', array('field')),
        array('field')
    )
    ->addForeignKey(
        $installer->getFkName('easytemplate/template_data_varchar', 'template_id', 'easytemplate/template', 'id'),
        'template_id',
        $installer->getTable('easytemplate/template'),
        'id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )

    ->setComment('Template Data Varchar');
$installer->getConnection()->createTable($table);

$installer->getConnection()->addIndex(
    $installer->getTable('easytemplate/template_data_varchar'),
    $installer->getIdxName(
        'easytemplate/template_data_varchar',
        array('template_id', 'field'),
        Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
    ),
    array('template_id', 'field'),
    Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
);

/* ---------------- template_data_text */

$table = $installer->getConnection()
    ->newTable($installer->getTable('easytemplate/template_data_text'))
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
        'template_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
            'unsigned' => true,
            'nullable' => false,
        ),
        'block_id'
    )
    ->addColumn(
        'field',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        255,
        array(
            'nullable' => false,
        ),
        'field'
    )
    ->addColumn(
        'value',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        null,
        array(),
        'value'
    )

    ->addIndex(
        $installer->getIdxName('easytemplate/template_data_text', array('field')),
        array('field')
    )
    ->addForeignKey(
        $installer->getFkName('easytemplate/template_data_text', 'template_id', 'easytemplate/template', 'id'),
        'template_id',
        $installer->getTable('easytemplate/template'),
        'id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )

    ->setComment('Template Data Text');
$installer->getConnection()->createTable($table);

$installer->getConnection()->addIndex(
    $installer->getTable('easytemplate/template_data_text'),
    $installer->getIdxName(
        'easytemplate/template_data_text',
        array('template_id', 'field'),
        Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
    ),
    array('template_id', 'field'),
    Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
);

/* ---------------- template_data_int */

$table = $installer->getConnection()
    ->newTable($installer->getTable('easytemplate/template_data_int'))
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
        'template_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
            'unsigned' => true,
            'nullable' => false,
        ),
        'block_id'
    )
    ->addColumn(
        'field',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        255,
        array(
            'nullable' => false,
        ),
        'field'
    )
    ->addColumn(
        'value',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(),
        'value'
    )

    ->addIndex(
        $installer->getIdxName('easytemplate/template_data_int', array('field')),
        array('field')
    )
    ->addForeignKey(
        $installer->getFkName('easytemplate/template_data_int', 'template_id', 'easytemplate/template', 'id'),
        'template_id',
        $installer->getTable('easytemplate/template'),
        'id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )

    ->setComment('Template Data Int');
$installer->getConnection()->createTable($table);

$installer->getConnection()->addIndex(
    $installer->getTable('easytemplate/template_data_int'),
    $installer->getIdxName(
        'easytemplate/template_data_int',
        array('template_id', 'field'),
        Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
    ),
    array('template_id', 'field'),
    Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
);

/* ---------------- template_data_datetime */

$table = $installer->getConnection()
    ->newTable($installer->getTable('easytemplate/template_data_datetime'))
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
        'template_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
            'unsigned' => true,
            'nullable' => false,
        ),
        'block_id'
    )
    ->addColumn(
        'field',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        255,
        array(
            'nullable' => false,
        ),
        'field'
    )
    ->addColumn(
        'value',
        Varien_Db_Ddl_Table::TYPE_DATETIME,
        null,
        array(),
        'value'
    )

    ->addIndex(
        $installer->getIdxName('easytemplate/template_data_datetime', array('field')),
        array('field')
    )
    ->addForeignKey(
        $installer->getFkName('easytemplate/template_data_datetime', 'template_id', 'easytemplate/template', 'id'),
        'template_id',
        $installer->getTable('easytemplate/template'),
        'id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )

    ->setComment('Template Data Datetime');
$installer->getConnection()->createTable($table);

$installer->getConnection()->addIndex(
    $installer->getTable('easytemplate/template_data_datetime'),
    $installer->getIdxName(
        'easytemplate/template_data_datetime',
        array('template_id', 'field'),
        Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
    ),
    array('template_id', 'field'),
    Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
);

/* ---------------- template_data_decimal */

$table = $installer->getConnection()
    ->newTable($installer->getTable('easytemplate/template_data_decimal'))
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
        'template_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
            'unsigned' => true,
            'nullable' => false,
        ),
        'block_id'
    )
    ->addColumn(
        'field',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        255,
        array(
            'nullable' => false,
        ),
        'field'
    )
    ->addColumn(
        'value',
        Varien_Db_Ddl_Table::TYPE_DECIMAL,
        '12,4',
        array(),
        'value'
    )

    ->addIndex(
        $installer->getIdxName('easytemplate/template_data_decimal', array('field')),
        array('field')
    )
    ->addForeignKey(
        $installer->getFkName('easytemplate/template_data_decimal', 'template_id', 'easytemplate/template', 'id'),
        'template_id',
        $installer->getTable('easytemplate/template'),
        'id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )

    ->setComment('Template Data Decimal');
$installer->getConnection()->createTable($table);

$installer->getConnection()->addIndex(
    $installer->getTable('easytemplate/template_data_decimal'),
    $installer->getIdxName(
        'easytemplate/template_data_decimal',
        array('template_id', 'field'),
        Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
    ),
    array('template_id', 'field'),
    Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
);

$installer->endSetup();
