<?php

/**
 * Class Webguys_Easytemplate_Block_Input_Renderer_Multiselect
 *
 */
class Webguys_Easytemplate_Block_Input_Renderer_Multiselect extends Webguys_Easytemplate_Block_Input_Renderer_Select
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('easytemplate/input/renderer/multiselect.phtml');
    }

    public function getDefaultBackendModel()
    {
        return Mage::getModel('easytemplate/template_data_varchar');
    }

    public function isSelected($value)
    {
        $values = explode(',', $this->getValue());
        return in_array($value, $values);
    }
}
