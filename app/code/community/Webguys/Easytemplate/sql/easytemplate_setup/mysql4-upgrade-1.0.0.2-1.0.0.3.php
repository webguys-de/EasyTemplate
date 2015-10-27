<?php

/* @var $installer Mage_Core_Model_Resource_Setup */

$installer = $this;

$installer->startSetup();

$this->addAttribute(
    'catalog_category',
    'use_easytemplate',
    array(
        'group' => 'Display Settings',
        'input' => 'select',
        'type' => 'int',
        'label' => 'Use easy template',
        'backend' => '',
        'visible' => true,
        'source' => 'eav/entity_attribute_source_boolean',
        'required' => false,
        'visible_on_front' => true,
        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
        'comment' => 'Use Easy template instead of magento block',
        'sort_order' => '15',
    )
);

$installer->endSetup();
