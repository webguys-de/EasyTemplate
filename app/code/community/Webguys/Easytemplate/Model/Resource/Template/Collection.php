<?php

/**
 * Class Webguys_Easytemplate_Model_Resource_Template_Collection
 *
 */
class Webguys_Easytemplate_Model_Resource_Template_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('easytemplate/template');
    }

    public function addGroupFilter($group)
    {
        if ($group instanceof Webguys_Easytemplate_Model_Group) {
            $group = $group->getId();
        }

        $this->addFieldToFilter('group_id', $group);

        return $this;
    }
}