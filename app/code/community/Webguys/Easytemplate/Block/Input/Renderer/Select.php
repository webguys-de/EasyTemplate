<?php

class Webguys_Easytemplate_Block_Input_Renderer_Select extends Webguys_Easytemplate_Block_Input_Renderer_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('easytemplate/input/renderer/select.phtml');
    }

    public function getOptionValues()
    {
        $source = $this->getSource();

    }
}