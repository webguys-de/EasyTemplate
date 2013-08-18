<?php

class Webguys_Easytemplate_Block_Input_Renderer_Abstract extends Mage_Core_Block_Abstract
{

    protected $_parent_field = null;

    public function setField($field)
    {
        $this->_parent_field = $field;
    }

}