<?php

/**
 * Class Webguys_Easytemplate_Block_Input_Renderer_Select
 *
 */
class Webguys_Easytemplate_Block_Input_Renderer_Select extends Webguys_Easytemplate_Block_Input_Renderer_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('easytemplate/input/renderer/select.phtml');
    }

    public function getDefaultBackendModel()
    {
        return Mage::getModel('easytemplate/template_data_varchar');
    }

    public function getOptionValues()
    {
        /** @var $source Webguys_Easytemplate_Model_Input_Renderer_Source_Abstract */
        $source = $this->getSource();

        if (method_exists($source, 'getAllOptions')) {
            $options = $source->getAllOptions();
            $result = array();
            foreach ($options as $option) {
                $result[$option['value']] = $option['label'];
            }
            return $result;
        }

        if (method_exists($source, 'getOptionValues')) {
            return $source->getOptionValues();
        }

        return false;
    }
}
