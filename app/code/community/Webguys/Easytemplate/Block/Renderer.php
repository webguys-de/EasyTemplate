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
                $active = $template->getActive();
                $validFrom = ($template->getValidFrom()) ? strtotime($template->getValidFrom()) : false;
                $validTo = ($template->getValidTo()) ? strtotime($template->getValidTo()) : false;

                if ($active && (!$validFrom || $validFrom <= $time) && (!$validTo || $validTo >= $time)) {

                    /** @var $childBlock Webguys_Easytemplate_Block_Template */
                    $childBlock = $this->getLayout()->createBlock($model->getType());
                    $childBlock->setTemplate($model->getTemplate());
                    $childBlock->setTemplateModel($template);
                    $childBlock->setTemplateCode( $template->getCode() );


                    /** @var $field Webguys_Easytemplate_Model_Input_Parser_Field */
                    foreach ($model->getFields() as $field) {
                        /** @var $inputValidator Webguys_Easytemplate_Model_Input_Renderer_Validator_Base */
                        $inputValidator = $field->getInputRendererValidator();
                        $inputValidator->setTemplate($template);
                        $inputValidator->setField($field);

                        $frontendValue = $inputValidator->prepareForFrontend($template->getFieldData($field->getCode()));
                        if ($frontendValue) {

                            $valueTransport = new Varien_Object();
                            $valueTransport->setValue($frontendValue);

                            Mage::dispatchEvent('easytemplate_frontend_prepared_var', array(
                                'template' => $template,
                                'template_model' => $model,
                                'field' => $field,
                                'block' => $childBlock,
                                'validator' => $inputValidator,
                                'value' => $valueTransport
                            ));

                            $childBlock->setData($field->getCode(), $valueTransport->getValue());
                        }
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