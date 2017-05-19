<?php

/**
 * Class Webguys_Easytemplate_Helper_Block
 *
 */
class Webguys_Easytemplate_Helper_Block extends Mage_Core_Helper_Abstract
{
    const ENTITY_TYPE_BLOCK = 'cms_block';

    public function isEasyTemplateBlock($blockId)
    {
        $block = Mage::getModel('cms/block');
        $block->setStoreId(Mage::app()->getStore()->getId());
        $block->load($blockId);

        if ($block->getId() && $block->getViewMode() == Webguys_Easytemplate_Model_Config_Source_Cms_Page_Viewmode::VIEWMODE_EASYTPL) {
            return $block->getId();
        }

        return false;
    }

    /**
     * Returns an existing block entry or creates a new one
     *
     * @param $id BlockId
     * @return Webguys_Easytemplate_Model_Group
     */
    public function getGroupByBlockId($id)
    {
        /** @var $collection Webguys_Easytemplate_Model_Resource_Group_Collection */
        $collection = Mage::getModel('easytemplate/group')->getCollection()
            ->addFieldToFilter('entity_type', self::ENTITY_TYPE_BLOCK)
            ->addFieldToFilter('entity_id', $id)
            ->addFieldToFilter('copy_of', array('null' => true))
            ->load();

        if ($collection->getSize() >= 1) {
            return $collection->getFirstItem()->getCopyOfInstance();
        } else {
            // Return new item
            /** @var $newItem Webguys_Easytemplate_Model_Group */
            $newItem = Mage::getModel('easytemplate/group');
            $newItem->setEntityType(self::ENTITY_TYPE_BLOCK);
            $newItem->setEntityId($id);
            $newItem->save();

            return $newItem;
        }
    }
}
