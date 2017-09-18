<?php

/**
 * Class Webguys_Easytemplate_Model_Input_Renderer_Source_Values
 *
 */
class Webguys_Easytemplate_Model_Input_Renderer_Source_Values extends Webguys_Easytemplate_Model_Input_Renderer_Source_Abstract
{
    public function getOptionValues()
    {
        $config = $this->getParentField()->getConfig();
        $res = $config->getNode('values')->asArray();
        return $this->translateOptions($res);
    }
}
