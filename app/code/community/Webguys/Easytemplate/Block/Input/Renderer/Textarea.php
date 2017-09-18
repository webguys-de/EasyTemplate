<?php

/**
 * Class Webguys_Easytemplate_Block_Input_Renderer_Textarea
 *
 */
class Webguys_Easytemplate_Block_Input_Renderer_Textarea extends Webguys_Easytemplate_Block_Input_Renderer_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('easytemplate/input/renderer/textarea.phtml');
    }

    public function getDefaultBackendModel()
    {
        return Mage::getModel('easytemplate/template_data_text');
    }
}
