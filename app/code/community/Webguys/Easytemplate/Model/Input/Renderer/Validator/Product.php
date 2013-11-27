<?php

class Webguys_Easytemplate_Model_Input_Renderer_Validator_Product extends Webguys_Easytemplate_Model_Input_Renderer_Validator_Base
{

    public function prepareForSave($data)
    {
        if ( is_numeric( $data ) )
        {
            return $data;
        }
        return end( explode('/', $data) );
    }



}
