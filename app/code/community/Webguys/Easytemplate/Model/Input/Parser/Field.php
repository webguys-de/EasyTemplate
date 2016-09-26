<?php

/**
 * Class Webguys_Easytemplate_Model_Input_Parser_Field
 *
 * @method getLabel
 * @method getSortOrder
 * @method getDefaultValue
 * @method getComment
 * @method getRequired
 * @method setTemplate
 * @method getTemplate
 */
class Webguys_Easytemplate_Model_Input_Parser_Field extends Webguys_Easytemplate_Model_Input_Parser_Abstract
{
    protected $_backendModel;
    protected $_inputRenderer;

    public function getBackendModelAlias($name)
    {
        if (strpos($name, '/') === false) {
            $name = 'easytemplate/template_data_' . $name;
        }

        return $name;
    }

    public function getInputRenderAlias($name)
    {
        if (strpos($name, '/') === false) {
            $name = 'easytemplate/input_renderer_' . $name;
        }

        return $name;
    }

    /**
     * @return Webguys_Easytemplate_Model_Template_Data_Abstract
     */
    public function getBackendModel()
    {
        if (is_null($this->_backendModel)) {
            if ($backendmodel = $this->getData('backend_model')) {
                $model = Mage::getModel(
                    $this->getBackendModelAlias($backendmodel)
                );
            } else {
                $inputRenderer = $this->getInputRenderer();
                $model = $inputRenderer->getDefaultBackendModel();
            }

            $model->setParentParserField($this);

            $this->_backendModel = $model;
        }
        return $this->_backendModel;
    }

    /**
     * @return Webguys_Easytemplate_Block_Input_Renderer_Abstract
     */
    public function getInputRenderer()
    {
        if (is_null($this->_inputRenderer)) {
            $template = $this->getTemplate();
            $name = $template->getCode() . '_' . $this->getCode();

            /** @var $block Webguys_Easytemplate_Block_Input_Renderer_Abstract */
            $block = Mage::app()->getLayout()->createBlock(
                $this->getBackendModelAlias($this->getData('input_renderer')),
                'easytemplate_template_field_' . $name
            );
            $block->setParentParserField($this);
            $block->setCode($this->getCode());
            $block->setLabel($this->getLabel());
            $block->setComment($this->getComment());
            $block->setDefault($this->getDefaultValue());
            $block->setRequired($this->getRequired());
            $block->setSource($this->getInputRendererSource());

            $this->_inputRenderer = $block;
        }

        return $this->_inputRenderer;
    }

    /**
     *
     * @return Webguys_Easytemplate_Model_Input_Renderer_Validator_Base
     */
    public function getInputRendererValidator()
    {
        $modelName = str_replace('input_renderer', 'input_renderer_validator', $this->getData('input_renderer'));

        if ($model = @Mage::getModel($modelName)) {
            return $model;
        } else {
            return Mage::getModel('easytemplate/input_renderer_validator_base');
        }
    }

    public function getInputRendererSource()
    {
        $inputRendererSource = $this->getData('input_renderer_source');
        $rendererModel = Mage::getModel($inputRendererSource);

        if ($rendererModel) {

            if ($rendererModel instanceof Webguys_Easytemplate_Model_Input_Renderer_Source_Abstract) {
                $rendererModel->setParentField($this);
            }

            return $rendererModel;
        }

        return false;
    }

    public function getConfigAttribute($name)
    {
        return (string)$this->_config->getNode($name);
    }
}