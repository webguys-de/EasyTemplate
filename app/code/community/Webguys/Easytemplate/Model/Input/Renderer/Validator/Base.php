<?php

/**
 * Class Webguys_Easytemplate_Model_Input_Renderer_Validator_Base
 *
 * @method getTemplate
 * @method setTemplate
 * @method getField
 * @method setField
 */
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
     * @param $value
     * @param $oldValue
     * @return $this
     */
    public function beforeFieldSave($value, $oldValue)
    {
        Mage::dispatchEvent(
            'easytemplate_backend_field_save_before',
            array(
                'template' => $this->getTemplate(),
                'field' => $this->getField(),
                'old_value' => $oldValue,
                'value' => $value
            )
        );

        return $value;
    }

    /**
     * @param $value
     * @return $this
     */
    public function afterFieldSave($value)
    {
        Mage::dispatchEvent(
            'easytemplate_backend_field_save_after',
            array(
                'template' => $this->getTemplate(),
                'field' => $this->getField(),
                'value' => $value
            )
        );

        return $this;
    }
}
