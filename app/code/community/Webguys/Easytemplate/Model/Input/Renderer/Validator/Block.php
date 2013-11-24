<?php

/**
 * Class Webguys_Easytemplate_Model_Input_Renderer_Validator_Block
 *
 */
class Webguys_Easytemplate_Model_Input_Renderer_Validator_Block extends Webguys_Easytemplate_Model_Input_Renderer_Validator_Base
{
    public function prepareForFrontend($data)
    {
        if (is_numeric($data)) {
            /** @var $block Mage_Cms_Model_Block */
            $block = Mage::getModel('cms/block');
            $block->load($data);

            if ($block->getId()) {
                /** @var $newBlock Mage_Cms_Block_Block */
                $newBlock = Mage::app()->getLayout()->createBlock('cms/block');
                $newBlock->setBlockId($block->getId());
                return $newBlock->toHtml();
            }
        }

        return '';
    }
}
