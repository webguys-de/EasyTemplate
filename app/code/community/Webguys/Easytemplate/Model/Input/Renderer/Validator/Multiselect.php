<?php

/**
 * Class Webguys_Easytemplate_Model_Input_Renderer_Validator_Multiselect
 *
 */
class Webguys_Easytemplate_Model_Input_Renderer_Validator_Multiselect extends Webguys_Easytemplate_Model_Input_Renderer_Validator_Base
{
    public function prepareForFrontend($data)
    {
        return explode(',', $data);
    }
}
