<?php

/**
 * Class Webguys_Easytemplate_Block_Adminhtml_Cms_Block_Edit_Tabs
 *
 */
class Webguys_Easytemplate_Block_Adminhtml_Cms_Block_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('block_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('cms')->__('Block Information'));
    }
}
