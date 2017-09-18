<?php

/** @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->run("
    ALTER TABLE  `" . $this->getTable('easytemplate/group') . "` ADD `copy_of` smallint(6) NULL;
");

$installer->endSetup();
