<?php

class Webguys_Easytemplate_Helper_Page extends Mage_Core_Helper_Abstract
{
    public function isEasyTemplatePage($pageId)
    {
        $page = Mage::getSingleton('cms/page');
        $page->setStoreId(Mage::app()->getStore()->getId());
        $page->load($pageId);

        return ($page->getId() && $page->getViewMode() == Webguys_Easytemplate_Model_Config_Source_Cms_Page_Viewmode::VIEWMODE_EASYTPL);
    }
}