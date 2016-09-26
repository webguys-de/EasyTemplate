<?php

/**
 * Class Webguys_Easytemplate_Helper_File
 *
 */
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

    public function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != '.' && $object != '..') {
                    if (filetype($dir . DS . $object) == 'dir') {
                        $this->rrmdir($dir . DS . $object);
                    } else {
                        unlink($dir . DS . $object);
                    }
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }
}