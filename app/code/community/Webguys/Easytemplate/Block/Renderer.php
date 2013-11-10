<?php

/**
 * Class Webguys_Easytemplate_Block_Renderer
 *
 * @method getGroupId
 * @method setGroupId
 */
class Webguys_Easytemplate_Block_Renderer extends Mage_Core_Block_Template
{
    public function setChildsBasedOnGroup($group)
    {
        /** @var $configModel Webguys_Easytemplate_Model_Input_Parser */
        $configModel = Mage::getSingleton('easytemplate/input_parser');

        $position = 1;
        $time = Mage::app()->getLocale()->storeTimeStamp(Mage::app()->getStore()->getId());

        /** @var $template Webguys_Easytemplate_Model_Template */
        foreach ($group->getTemplateCollection() as $template) {
            if ($model = $configModel->getTemplate( $template->getCode() )) {
                $validFrom = ($template->getValidFrom()) ? strtotime($template->getValidFrom()) : false;
                $validTo = ($template->getValidTo()) ? strtotime($template->getValidTo()) : false;

                if ((!$validFrom || $validFrom < $time) && (!$validTo || $validTo > $time)) {
                    $childBlock = $this->getLayout()->createBlock($model->getType());
                    $childBlock->setTemplate($model->getTemplate());

                    /** @var $field Webguys_Easytemplate_Model_Input_Parser_Field */
                    foreach ($model->getFields() as $field) {
                        $childBlock->setData($field->getCode(), $template->getFieldData($field->getCode()));
                    }

                    $this->setChild('block_'.$position.'_'.$template->getCode(), $childBlock);
                    $position++;
                }
            }
        }

        return $this;
    }

    protected function _beforeToHtml()
    {
        $this->setChildsBasedOnGroup( $this->getGroupId() );
        return $this;
    }

    protected function _toHtml()
    {
        return $this->getChildHtml();
    }
}