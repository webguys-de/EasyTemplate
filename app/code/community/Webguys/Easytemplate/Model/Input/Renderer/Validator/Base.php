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

    /**
     * @param $backendModel Webguys_Easytemplate_Model_Template_Data_Abstract
     * @param $field Webguys_Easytemplate_Model_Input_Parser_Field
     * @param $value mixed
     */
    public function beforeFieldSave($backendModel, $field, $value)
    {
        Mage::dispatchEvent('easytemplate_backend_field_save_before', array(
            'backend_model' => $backendModel,
            'field' => $field,
            'value' => $value
        ));

        return $this;
    }

    /**
     * @param $backendModel Webguys_Easytemplate_Model_Template_Data_Abstract
     * @param $field Webguys_Easytemplate_Model_Input_Parser_Field
     * @param $value mixed
     */
    public function afterFieldSave($backendModel, $field, $value)
    {
        Mage::dispatchEvent('easytemplate_backend_field_save_after', array(
            'backend_model' => $backendModel,
            'field' => $field,
            'value' => $value
        ));

        return $this;
    }
}