<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Poll
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


/* @var $installer Mage_Core_Model_Resource_Setup */

$installer = $this;

$installer->startSetup();

/**
 * Create table 'poll'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('easytemplate/backend_varchar'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Id')
    ->addColumn('block_id', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ), 'block_id')
    ->addColumn('code', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ), 'code')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
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
    ->setComment('Varchar-Data');
$installer->getConnection()->createTable($table);


$installer->endSetup();

