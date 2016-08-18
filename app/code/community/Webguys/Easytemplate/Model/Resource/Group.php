<?php

/**
 * Class Webguys_Easytemplate_Model_Resource_Group
 *
 */
class Webguys_Easytemplate_Model_Resource_Group
    extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('easytemplate/group', 'id');
    }
}