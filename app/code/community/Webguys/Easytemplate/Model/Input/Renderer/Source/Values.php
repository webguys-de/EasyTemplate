<?php

/**
 * Class Webguys_Easytemplate_Model_Input_Renderer_Source_Values
 *
 */
class Webguys_Easytemplate_Model_Input_Renderer_Source_Values extends Webguys_Easytemplate_Model_Input_Renderer_Source_Abstract
{
    protected function translate(&$item)
    {
        /** @var $helper Webguys_Easytemplate_Helper_Data */
        $helper = Mage::helper('easytemplate');
        $item = $helper->__($item);
    }

    public function getOptionValues()
    {
        $config = $this->getParentField()->getConfig();
        $res = $config->getNode('values')->asArray();
        array_walk($res, array($this, 'translate'));
        return $res;
    }
}