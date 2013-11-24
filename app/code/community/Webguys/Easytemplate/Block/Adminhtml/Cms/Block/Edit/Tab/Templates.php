<?php

/**
 * Class Webguys_Easytemplate_Block_Adminhtml_Cms_Block_Edit_Tab_Templates
 *
 */
class Webguys_Easytemplate_Block_Adminhtml_Cms_Block_Edit_Tab_Templates
    extends Webguys_Easytemplate_Block_Adminhtml_Edit_Template
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    /**
     * @return Webguys_Easytemplate_Model_Group
     */
    public function getGroup()
    {
        if ($page = $this->getObjectOfType()) {
            return Mage::helper('easytemplate/block')->getGroupByBlockId( $page->getId() );
        }
        return Mage::getModel('easytemplate/group');
    }

    public function getType()
    {
        return 'block';
    }

    public function getObjectOfType()
    {
        return Mage::registry('cms_block');
    }
}