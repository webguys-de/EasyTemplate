<?php

/**
 * Class Webguys_Easytemplate_Model_Input_Renderer_Source_Blocks
 *
 */
class Webguys_Easytemplate_Model_Input_Renderer_Source_Blocks extends Webguys_Easytemplate_Model_Input_Renderer_Source_Abstract
{
    public function getOptionValues()
    {
        $blockCollection = Mage::getModel('cms/block')->getCollection()
            ->addFieldToFilter('is_active', 1)
            ->load();

        $values = array();

        foreach ($blockCollection as $block) {
            $values[$block->getId()] = $block->getTitle();
        }

        return $this->translateOptions($values);
    }
}