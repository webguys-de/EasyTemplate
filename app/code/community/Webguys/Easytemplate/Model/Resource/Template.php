<?php

class Webguys_Easytemplate_Model_Resource_Template
    extends Mage_Core_Model_Resource_Db_Abstract
{

    public function _construct()
    {
        $this->_init('easytemplate/template', 'id');
    }

}