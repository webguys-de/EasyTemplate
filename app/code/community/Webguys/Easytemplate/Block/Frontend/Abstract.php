<?php

class Webguys_Easytemplate_Block_Frontend_Abstract extends Mage_Core_Block_Template
{
    public function setChildsBasedOnGroup($group)
    {
        /** @var $configModel Webguys_Easytemplate_Model_Input_Parser */
        $configModel = Mage::getSingleton('easytemplate/input_parser');

        $position = 1;

        /** @var $template Webguys_Easytemplate_Model_Template */
        foreach ($group->getTemplateCollection() as $template) {
            if ($model = $configModel->getTemplate( $template->getCode() )) {
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

    protected function _toHtml()
    {
        return $this->getChildHtml();
    }
}