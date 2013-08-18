<?php

class Webguys_Easytemplate_Block_Input_Renderer_Abstract extends Mage_Core_Block_Abstract
{

    protected $_parent_parser_field = null;

    public function setParentParserField($field)
    {
        $this->_parent_parser_field = $field;
    }

}