<?php

abstract class Webguys_Easytemplate_Model_Template_Data_Abstract
    extends Mage_Core_Model_Abstract
{

    protected $_parent_parser_field = null;

    public function setParentParserField($field)
    {
        $this->_parent_parser_field = $field;
    }

}