<?php

class Webguys_Easytemplate_Model_Input_Renderer_Validator_Base extends Mage_Core_Model_Abstract
{
    /**
     * Allows to modify the value before it will be delivered to the frontend
     *
     * @param $data
     * @return mixed
     */
    public function prepareForFrontend($data)
    {
        return $data;
    }

    public function prepareForSave($data)
    {
        return $data;
    }

    /**
     * @param $template Webguys_Easytemplate_Model_Template
     * @param $backendModel Webguys_Easytemplate_Model_Template_Data_Abstract
     * @param $field Webguys_Easytemplate_Model_Input_Parser_Field
     * @param $value mixed
     */
    public function beforeFieldSave($template, $backendModel, $field, $value)
    {
        Mage::dispatchEvent('easytemplate_backend_field_save_before', array(
            'template' => $template,
            'backend_model' => $backendModel,
            'field' => $field,
            'value' => $value
        ));

        return $this;
    }

    /**
     * @param $template Webguys_Easytemplate_Model_Template
     * @param $backendModel Webguys_Easytemplate_Model_Template_Data_Abstract
     * @param $field Webguys_Easytemplate_Model_Input_Parser_Field
     * @param $value mixed
     */
    public function afterFieldSave($template, $backendModel, $field, $value)
    {
        Mage::dispatchEvent('easytemplate_backend_field_save_after', array(
            'template' => $template,
            'backend_model' => $backendModel,
            'field' => $field,
            'value' => $value
        ));

        return $this;
    }
}