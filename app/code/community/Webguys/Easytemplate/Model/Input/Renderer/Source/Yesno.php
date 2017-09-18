<?php

/**
 * Class Webguys_Easytemplate_Model_Input_Renderer_Source_Yesno
 *
 */
class Webguys_Easytemplate_Model_Input_Renderer_Source_Yesno extends Webguys_Easytemplate_Model_Input_Renderer_Source_Abstract
{
    public function getOptionValues()
    {
        return $this->translateOptions(
            array(
                1 => 'Yes',
                0 => 'No'
            )
        );
    }
}
