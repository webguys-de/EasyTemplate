<?php

/**
 * Class Webguys_Easytemplate_Model_Input_Renderer_Validator_Image
 *
 */
class Webguys_Easytemplate_Model_Input_Renderer_Validator_Image extends Webguys_Easytemplate_Model_Input_Renderer_Validator_Base
{

    public function prepareForFrontend($data)
    {
        if (empty($data)) {
            return $data;
        }

        return Mage::app()->getStore()->getBaseUrl(
            Mage_Core_Model_Store::URL_TYPE_MEDIA
        ) . Mage_Cms_Model_Wysiwyg_Config::IMAGE_DIRECTORY . '/' . $data;
    }

}
