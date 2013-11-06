<?php

/**
 * Class Webguys_Easytemplate_Block_Frontend_Page
 *
 * @method setPageId
 * @method getPageId
 */
class Webguys_Easytemplate_Block_Frontend_Page extends Webguys_Easytemplate_Block_Frontend_Abstract
{
    protected function _beforeToHtml()
    {
        $page = Mage::getSingleton('cms/page');
        $page->setStoreId(Mage::app()->getStore()->getId());
        $page->load($this->getPageId());

        if ($page->getId()) {
            /** @var $helper Webguys_Easytemplate_Helper_Data */
            $helper = Mage::helper('easytemplate');
            $group = $helper->getGroupByPageId($page->getId());

            $this->setChildsBasedOnGroup($group);
        }

        return parent::_beforeToHtml();
    }

}