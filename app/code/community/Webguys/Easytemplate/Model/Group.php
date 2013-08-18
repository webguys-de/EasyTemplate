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

    protected function _construct()
    {
        $this->_init('easytemplate/group');
    }

    public function getTemplateCollection()
    {
        /** @var $collection Webguys_Easytemplate_Model_Resource_Group_Collection */
        $collection = Mage::getModel('easytemplate/template')->getCollection();
        $collection->addGroupFilter($this);
        return $collection;
    }

}