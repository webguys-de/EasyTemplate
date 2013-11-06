<?php

class Webguys_Easytemplate_Helper_Data extends Mage_Core_Helper_Abstract
{

    const ENTITY_TYPE_PAGE = 'cms_page';

    public function getGroupByPageId($id)
    {
        /** @var $collection Webguys_Easytemplate_Model_Resource_Group_Collection */
        $collection = Mage::getModel('easytemplate/group')->getCollection()
            ->addFieldToFilter('entity_type', self::ENTITY_TYPE_PAGE)
            ->addFieldToFilter('entity_id', $id)
            ->load();

        if ($collection->getSize() >= 1) {
            return $collection->getFirstItem();
        }
        else {
            // Return new item
            /** @var $newItem Webguys_Easytemplate_Model_Group */
            $newItem = Mage::getModel('easytemplate/group');
            $newItem->setEntityType(self::ENTITY_TYPE_PAGE);
            $newItem->setEntityId($id);
            $newItem->save();

            return $newItem;
        }
    }

    public function getTemplateModel( $template_selector )
    {

    }

}