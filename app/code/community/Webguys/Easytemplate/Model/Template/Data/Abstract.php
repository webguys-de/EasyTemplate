<?php

abstract class Webguys_Easytemplate_Model_Template_Data_Abstract
    extends Mage_Core_Model_Abstract
{

    protected $_parent_field = null;

    public function setField($field)
    {
        $this->_parent_field = $field;
    }

}