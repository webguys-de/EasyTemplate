<?php

/**
 * Class Webguys_Easytemplate_Block_Input_Renderer_Block
 *
 */
class Webguys_Easytemplate_Block_Input_Renderer_Block extends Webguys_Easytemplate_Block_Input_Renderer_Select
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('easytemplate/input/renderer/select.phtml');
    }

    public function getDefaultBackendModel()
    {
        return Mage::getModel('easytemplate/template_data_int');
    }
}
