<?php

/**
 * Class Webguys_Easytemplate_Model_Group
 *
 * @method setEntityType
 * @method getEntityType
 * @method setEntityId
 * @method getEntityId
 */
class Webguys_Easytemplate_Model_Group
 extends Mage_Core_Model_Abstract
{
    const ENTITY_TYPE_PAGE = 'cms_page';

    protected function _construct()
    {
        $this->_init('easytemplate/group');
    }

    public function getTemplateCollection()
    {
        /** @var $collection Webguys_Easytemplate_Model_Resource_Template_Collection */
        $collection = Mage::getModel('easytemplate/template')->getCollection();
        $collection->addGroupFilter($this);
        return $collection;
    }

    public function loadPageById($id)
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

}