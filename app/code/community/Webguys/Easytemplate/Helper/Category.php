<?php

/**
 * Class Webguys_Easytemplate_Helper_Block
 *
 */
class Webguys_Easytemplate_Helper_Category extends Mage_Core_Helper_Abstract
{
    const ENTITY_TYPE_CATEGORY = 'catalog_category';

    /**
     * Returns an existing block entry or creates a new one
     *
     * @param int $id ID of category to handle
     * @param int $store_id ID of store to handle
     * @param boolean $store_fallback fall back to default scope is there is nothing on store view scope
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

            // do not use empty store view groups and also filter deactivated items
            $collection->getSelect()
                ->joinLeft('easytemplate','easytemplate.group_id = main_table.id AND active = 1', array())
                ->group(array('group_id','store_id'))
                ->having('(count(easytemplate.group_id) > 0 AND store_id != 0) OR store_id = 0')
            ;
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
