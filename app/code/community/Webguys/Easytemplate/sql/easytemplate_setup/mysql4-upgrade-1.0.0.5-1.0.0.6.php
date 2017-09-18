<?php

/** @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->run("
    ALTER TABLE  `" . $this->getTable('easytemplate/template') . "` ADD `parent_id` INT(10)  UNSIGNED  NULL  DEFAULT NULL  AFTER `valid_to`;
");

$installer->run("
  ALTER TABLE `" . $this->getTable('easytemplate/template') . "` ADD FOREIGN KEY (`parent_id`) REFERENCES `easytemplate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
");

$installer->endSetup();
