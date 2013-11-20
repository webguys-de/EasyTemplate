<?php

/**
 * Class Webguys_Easytemplate_Block_Input_Renderer_File
 *
 */
class Webguys_Easytemplate_Block_Input_Renderer_Link extends Webguys_Easytemplate_Block_Input_Renderer_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('easytemplate/input/renderer/link.phtml');
    }

}