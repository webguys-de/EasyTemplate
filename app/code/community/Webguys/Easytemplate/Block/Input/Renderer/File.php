<?php

class Webguys_Easytemplate_Block_Input_Renderer_File extends Webguys_Easytemplate_Block_Input_Renderer_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('easytemplate/input/renderer/file.phtml');
    }

    public function hasFile()
    {
        return isset($this->_value);
    }

    public function isImageFile()
    {
        // TODO: Determine if value is image
        return false;
    }

    public function getFileUrl()
    {
        // TODO: Get file url
        return Mage::getUrl('*/*/*');
    }
}