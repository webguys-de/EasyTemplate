<?php

/**
 * Class Webguys_Easytemplate_Model_Input_Renderer_Validator_File
 *
 */
class Webguys_Easytemplate_Model_Input_Renderer_Validator_File extends Webguys_Easytemplate_Model_Input_Renderer_Validator_Base
{
    protected $_deleteFile = false;

    public function prepareForFrontend($data)
    {
        if (empty($data)) {
            return $data;
        }

        /** @var $fileHelper Webguys_Easytemplate_Helper_File */
        $fileHelper = Mage::helper('easytemplate/file');

        $template = $this->getTemplate();

        return $fileHelper->getDestinationUrl($template->getGroupId(), $template->getId()) . '/' . $data;
    }

    public function prepareForSave($data)
    {
        if (isset($data['delete'])) {
            $this->_deleteFile = (bool)$data['delete'];

            if ($this->_deleteFile) {
                return '';
            }
        }

        if (empty($data['value']) && empty($data['existing'])) {
            return '';
        }

        $fileName = !empty($data['value']) ? $data['value'] : $data['existing'];
        return Mage_Core_Model_File_Uploader::getNewFileName(strtolower($fileName));
    }

    public function beforeFieldSave($value, $oldValue)
    {
        $value = parent::beforeFieldSave($value, $oldValue);

        $template = $this->getTemplate();

        /** @var $fileHelper Webguys_Easytemplate_Helper_File */
        $fileHelper = Mage::helper('easytemplate/file');
        $destinationPath = $fileHelper->getDestinationFilePath($template->getGroupId(), $template->getId());

        if ($oldValue && (($value && $oldValue != $value) || $this->_deleteFile)) {
            // Delete the old file
            $oldFilePath = sprintf('%s/%s', $destinationPath, $oldValue);
            if (file_exists($oldFilePath)) {
                @unlink($oldFilePath);
            }
        }

        if ($value) {
            $fileHelper->createTmpPath($template->getGroupId(), $template->getId());

            if ($this->uploadComplete()) {
                $uploaderData = array(
                    'tmp_name' => $this->extractFilePostInformation('tmp_name'),
                    'name' => $value
                );

                $uploader = Mage::getModel('core/file_uploader', $uploaderData);
                //$uploader->setAllowedExtensions(array('jpg','jpeg','gif','png','pdf'));
                $uploader->addValidateCallback(
                    'easytemplate_template_file',
                    $fileHelper,
                    'validateUploadFile'
                );
                $uploader->setAllowRenameFiles(false);
                $uploader->setFilesDispersion(false);
                $result = $uploader->save($destinationPath);

                Mage::dispatchEvent(
                    'easytemplate_upload_file_after',
                    array(
                        'result' => $result
                    )
                );

                $value = $result['file'];
            } else {
                // TODO: Error handling
            }
        }

        return $value;
    }

    protected function extractFilePostInformation($type)
    {
        $template = $this->getTemplate();
        $templateId = ($template->getTemporaryId()) ? $template->getTemporaryId() : $template->getId();
        return $_FILES['template'][$type][$templateId]['fields'][$this->getField()->getCode()];
    }

    protected function uploadComplete()
    {
        return ($this->extractFilePostInformation('error') === UPLOAD_ERR_OK);
    }
}
