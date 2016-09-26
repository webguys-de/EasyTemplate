<?php

/**
 * Class Webguys_Easytemplate_Helper_Page
 *
 */
class Webguys_Easytemplate_Helper_Page extends Mage_Core_Helper_Abstract
{
    const ENTITY_TYPE_PAGE = 'cms_page';

    public function isEasyTemplatePage($pageId)
    {
        $page = Mage::getSingleton('cms/page');
        $page->setStoreId(Mage::app()->getStore()->getId());
        $page->load($pageId);

        return ($page->getId() && $page->getViewMode() == Webguys_Easytemplate_Model_Config_Source_Cms_Page_Viewmode::VIEWMODE_EASYTPL);
    }

    /**
     * Returns an existing page entry or creates a new one
     *
     * @param $id PageId
     * @return Webguys_Easytemplate_Model_Group
     */
    public function getGroupByPageId($id)
    {
        /** @var $collection Webguys_Easytemplate_Model_Resource_Group_Collection */
        $collection = Mage::getModel('easytemplate/group')->getCollection()
            ->addFieldToFilter('entity_type', self::ENTITY_TYPE_PAGE)
            ->addFieldToFilter('entity_id', $id)
            ->addFieldToFilter('copy_of', array('null' => true))
            ->load();

        if ($collection->getSize() >= 1) {
            return $collection->setPageSize(1)->setCurPage(1)->getFirstItem()->getCopyOfInstance();
        } else {
            // Return new item
            /** @var $newItem Webguys_Easytemplate_Model_Group */
            $newItem = Mage::getModel('easytemplate/group');
            $newItem->setEntityType(self::ENTITY_TYPE_PAGE);
            $newItem->setEntityId($id);
            $newItem->save();

            return $newItem;
        }
    }
}