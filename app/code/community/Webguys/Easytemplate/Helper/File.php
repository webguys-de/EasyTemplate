<?php

class Webguys_Easytemplate_Helper_File extends Mage_Core_Helper_Abstract
{
    public function getDestinationUrl($groupId, $templateId)
    {
        return Mage::getBaseUrl('media') . 'easytemplate' . DS . $groupId . DS . $templateId;
    }

    public function getDestinationFilePath($groupId, $templateId)
    {
        return Mage::getBaseDir('media') . DS . 'easytemplate' . DS . $groupId . DS . $templateId;
    }

    public function createTmpPath($groupId, $templateId)
    {
        /** @var $configModel Mage_Core_Model_Config_Options */
        $configModel = Mage::getModel('core/config_options');
        return $configModel->createDirIfNotExists($this->getDestinationFilePath($groupId, $templateId));
    }

    public function validateUploadFile($filePath)
    {
        return file_exists($filePath);
    }
}