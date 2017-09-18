<?php

/** @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->run("
    ALTER TABLE  `" . $this->getTable('cms/page') . "` ADD `view_mode` VARCHAR( 20 ) NOT NULL DEFAULT 'core';
");

$installer->run("
    ALTER TABLE  `" . $this->getTable('cms/block') . "` ADD `view_mode` VARCHAR( 20 ) NOT NULL DEFAULT 'core';
");

$installer->endSetup();
