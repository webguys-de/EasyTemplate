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
}