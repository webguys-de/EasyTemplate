<?php

/**
 * Class Webguys_Easytemplate_Helper_Block
 *
 */
class Webguys_Easytemplate_Helper_Category extends Mage_Core_Helper_Abstract
{
    const ENTITY_TYPE_CATEGORY = 'catalog_category';

    /**
     * @param $id int CategoryId
     * @param $store_id int StoreId
     * @param bool $store_fallback
     * @return Webguys_Easytemplate_Model_Group
     */
    public function getGroupByCategoryId($id, $store_id, $store_fallback = false)
    {
        /** @var $collection Webguys_Easytemplate_Model_Resource_Group_Collection */
        $collection = Mage::getModel('easytemplate/group')->getCollection()
            ->addFieldToFilter('entity_type', self::ENTITY_TYPE_CATEGORY)
            ->addFieldToFilter('entity_id', $id)
            ->addFieldToFilter('copy_of', array('null' => true));

        if ($store_fallback) {
            $collection->addFieldToFilter('store_id', array('in' => array($store_id, 0)));
        } else {
            $collection->addFieldToFilter('store_id', $store_id);
        }

        $collection->addOrder('store_id', Webguys_Easytemplate_Model_Resource_Group_Collection::SORT_ORDER_DESC);
        $collection->setPageSize(1);
        $collection->setCurPage(1);

        $collection->load();

        if ($collection->getSize() >= 1) {
            return $collection->getFirstItem()->getCopyOfInstance();
        } else {
            // Return new item
            /** @var $newItem Webguys_Easytemplate_Model_Group */
            $newItem = Mage::getModel('easytemplate/group');
            $newItem->setEntityType(self::ENTITY_TYPE_CATEGORY);
            $newItem->setEntityId($id);
            $newItem->setStoreId($store_id);
            $newItem->save();

            return $newItem;
        }
    }
}
