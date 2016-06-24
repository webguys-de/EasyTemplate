<?php
namespace Webguys\Easytemplate\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $sql = file_get_contents(__DIR__.'/Schema.sql');
        $setup->getConnection()->multiQuery($sql);
        $setup->getConnection()->rawQuery("
    ALTER TABLE  `cms_page` ADD `view_mode` VARCHAR( 20 ) NOT NULL DEFAULT 'core';
");


        $setup->endSetup();
    }
}