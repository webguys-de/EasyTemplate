<?php

class Webguys_Easytemplate_Block_Input_Renderer_File extends Webguys_Easytemplate_Block_Input_Renderer_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('easytemplate/input/renderer/file.phtml');
    }
}