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
        $i = getimagesize($this->getFileUri(true));
        return (in_array($i[2] , array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP)));
    }

    public function getFileUri($asPath = false)
    {
        /** @var $fileHelper Webguys_Easytemplate_Helper_File */
        $fileHelper = Mage::helper('easytemplate/file');

        /** @var $templateModel Webguys_Easytemplate_Model_Template */
        $templateModel = $this->getTemplateModel();

        if ($asPath) {
            return $fileHelper->getDestinationFilePath($templateModel->getGroupId(), $templateModel->getId()). DS . $this->_value;
        } else {
            return $fileHelper->getDestinationUrl($templateModel->getGroupId(), $templateModel->getId()). DS . $this->_value;
        }
    }
}