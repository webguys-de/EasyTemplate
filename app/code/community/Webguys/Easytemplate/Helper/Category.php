<?php

/**
 * Class Webguys_Easytemplate_Helper_Block
 *
 */
class Webguys_Easytemplate_Helper_Category extends Mage_Core_Helper_Abstract
{
    const ENTITY_TYPE_BLOCK = 'catalog_category';

    /**
     * Returns an existing block entry or creates a new one
     *
     * @param $id CategoryId
     * @return Webguys_Easytemplate_Model_Group
     */
    public function getGroupByCategoryId($id)
    {
        /** @var $collection Webguys_Easytemplate_Model_Resource_Group_Collection */
        $collection = Mage::getModel('easytemplate/group')->getCollection()
            ->addFieldToFilter('entity_type', self::ENTITY_TYPE_BLOCK)
            ->addFieldToFilter('entity_id', $id)
            ->load();

        if ($collection->getSize() >= 1) {
            return $collection->getFirstItem();
        }
        else {
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