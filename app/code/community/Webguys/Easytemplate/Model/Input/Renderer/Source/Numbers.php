<?php

/**
 * Class Webguys_Easytemplate_Model_Input_Renderer_Source_Numbers
 *
 */
class Webguys_Easytemplate_Model_Input_Renderer_Source_Numbers extends Webguys_Easytemplate_Model_Input_Renderer_Source_Abstract
{
    public function getOptionValues()
    {
        $values = array();
        for ($i = 0; $i < 51; $i++) {
            $values[$i] = $i;
        }
        return $this->translateOptions($values);
    }
}
