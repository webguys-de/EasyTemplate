<?php

/**
 * Class Webguys_Easytemplate_Model_Resource_Group_Collection
 *
 */
class Webguys_Easytemplate_Model_Resource_Group_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('easytemplate/group');
    }
}