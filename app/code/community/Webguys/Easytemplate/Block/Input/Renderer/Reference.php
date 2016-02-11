<?php

class Webguys_Easytemplate_Block_Input_Renderer_Reference extends Webguys_Easytemplate_Block_Input_Renderer_Abstract
{

    public function __construct(array $args = array())
    {
        parent::__construct($args);
        $this->setTemplate('easytemplate/input/renderer/reference.phtml');
    }

    public function getDefaultBackendModel()
    {
        return Mage::getModel('easytemplate/template_data_varchar');
    }

    public function getBoxesHtml()
    {
        $html = '';
        if ($model = $this->getTemplateModel() )
        {
            $collection = $model->getCollection()->addFieldToFilter('parent_id',$model->getId());

            foreach($collection AS $subModel) {
                $subModel->load($subModel->getId());


                /** @var Webguys_Easytemplate_Block_Adminhtml_Edit_Box $boxBlock */
                $boxBlock = $this->getLayout()->createBlock('easytemplate/adminhtml_edit_box');
                $boxBlock->setTemplateModel($subModel);

                $html .= $boxBlock->toHtml();

            }
        }

        return $html;
    }

    public function getReference()
    {
        return $this->getParentParserField()->getConfigAttribute('reference');
    }

    public function getReferenceLabel()
    {
        return $this->getParentParserField()->getConfigAttribute('reference_button_label');
    }

    public function getReferenceDefaultName()
    {
        $configModel = Mage::getSingleton('easytemplate/input_parser');
        return $configModel->getTemplate($this->getReference())->getLabel();
    }

    public function getFieldsHtml()
    {
        $parentTemplate = $this->getParentParserField()->getTemplate();
        $parentTemplate->getAttribute('reference');

        $html = '';
        if ($model = $this->getTemplateModel() )
        {
            /** @var Webguys_Easytemplate_Model_Template $model */

            $collection = $model->getCollection()->addFieldToFilter('parent_id',$model->getId());

            foreach($collection AS $subModel) {
                $subModel->load( $subModel->getId() );

                /** @var Webguys_Easytemplate_Model_Template $subModel */

                foreach ($subModel->getFields() as $field) {
                    /** @var $field Webguys_Easytemplate_Model_Input_Parser_Field */

                    /** @var $inputRenderer Webguys_Easytemplate_Block_Input_Renderer_Abstract */
                    $inputRenderer = $field->getInputRenderer();

                    if( $subModel->getId() )
                    {
                        $inputRenderer->setTemplateModel($subModel);
                        $inputRenderer->setValue( $subModel->getFieldData( $field->getCode() ) );
                    }

                    $html .= $inputRenderer->toHtml();
                }

            }

        }

        return $html;
    }

}