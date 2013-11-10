<?php

/**
 * Class Webguys_Easytemplate_Model_Input_Renderer_Source_Values
 *
 */
class Webguys_Easytemplate_Model_Input_Renderer_Source_Values extends Webguys_Easytemplate_Model_Input_Renderer_Source_Abstract
{
    public function getOptionValues()
    {
        /** @var $helper Webguys_Easytemplate_Helper_Data */
        $helper = Mage::helper('easytemplate');

        $config = $this->getParentField()->getConfig();

        $res = array();
        foreach ($config->getNode('values') as $value) {
            // TODO: Das funktioniert so nicht
        }

        //return $res;
        return array('left' => $helper->__('bla'));
    }
}