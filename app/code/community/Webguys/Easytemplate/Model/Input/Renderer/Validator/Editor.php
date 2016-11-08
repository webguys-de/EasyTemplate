<?php

/**
 * Class Webguys_Easytemplate_Model_Input_Renderer_Validator_Product
 *
 */
class Webguys_Easytemplate_Model_Input_Renderer_Validator_Editor extends Webguys_Easytemplate_Model_Input_Renderer_Validator_Base
{
    public function prepareForFrontend($data)
    {
        /** @var $processor Mage_Cms_Model_Template_Filter */
        $processor = Mage::getModel('cms/template_filter');
        return $processor->filter($data);
    }
}