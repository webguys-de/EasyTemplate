<?php

/**
 * Class Webguys_Easytemplate_Block_Adminhtml_Edit_Renderer
 *
 * @method getCode
 */
class Webguys_Easytemplate_Block_Adminhtml_Edit_Renderer
    extends Mage_Adminhtml_Block_Widget
{
    protected $_template_model;

    /**
     * @return Webguys_Easytemplate_Model_Template
     */
    public function getTemplateModel()
    {
        return $this->_template_model;
    }

    public function setTemplateModel(Webguys_Easytemplate_Model_Template $model)
    {
        $this->_template_model = $model;
        return $this;
    }

    protected function _toHtml()
    {
        $html = '';
        if ($model = $this->getTemplateModel()) {

            foreach ($model->getFields() as $field) {
                /** @var $field Webguys_Easytemplate_Model_Input_Parser_Field */

                /** @var $inputRenderer Webguys_Easytemplate_Block_Input_Renderer_Abstract */
                $inputRenderer = $field->getInputRenderer();

                if ($this->getTemplateModel()->getId()) {
                    $inputRenderer->setTemplateModel($this->getTemplateModel());
                    $inputRenderer->setValue($this->getTemplateModel()->getFieldData($field->getCode()));
                }

                $html .= $inputRenderer->toHtml();
            }
        }
        return $html;
    }
}