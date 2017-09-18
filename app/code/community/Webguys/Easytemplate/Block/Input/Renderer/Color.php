<?php

/**
 * Class Webguys_Easytemplate_Block_Input_Renderer_Text
 *
 */
class Webguys_Easytemplate_Block_Input_Renderer_Color extends Webguys_Easytemplate_Block_Input_Renderer_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('easytemplate/input/renderer/color.phtml');
    }

    public function getDefaultBackendModel()
    {
        return Mage::getModel('easytemplate/template_data_varchar');
    }
}
