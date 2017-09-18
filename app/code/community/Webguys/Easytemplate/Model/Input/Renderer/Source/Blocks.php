<?php

/**
 * Class Webguys_Easytemplate_Model_Input_Renderer_Source_Blocks
 *
 */
class Webguys_Easytemplate_Model_Input_Renderer_Source_Blocks extends Webguys_Easytemplate_Model_Input_Renderer_Source_Abstract
{
    public function getOptionValues()
    {
        /** @var $blockCollection Mage_Cms_Model_Resource_Block_Collection */
        $blockCollection = Mage::getModel('cms/block')->getCollection()
            ->addFieldToFilter('is_active', 1);

        // Avoid to choose current block (will result in loop)
        if ($curBlock = Mage::registry('cms_block')) {
            $blockCollection->addFieldToFilter('main_table.block_id', array('neq' => $curBlock->getId()));
        }

        $blockCollection->load();

        $values = array();

        foreach ($blockCollection as $block) {
            $values[$block->getId()] = $block->getTitle();
        }

        return $this->translateOptions($values);
    }
}
