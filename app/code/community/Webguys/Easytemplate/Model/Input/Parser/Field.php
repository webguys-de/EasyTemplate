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

    public function getBackendModelAlias( $name )
    {
        if ( strpos($name, '/') === false )
        {
            $name = 'easytemplate/template_data_' . $name;
        }

        return $name;
    }

    public function getInputRenderAlias( $name )
    {
        if ( strpos($name, '/') === false )
        {
            $name = 'easytemplate/input_renderer_' . $name;
        }

        return $name;
    }

    /**
     * @return Webguys_Easytemplate_Model_Template_Data_Abstract
     */
    public function getBackendModel()
    {
        $model = Mage::getModel(
            $this->getBackendModelAlias( $this->getData('backend_model') )
        );

        $model->setParentParserField( $this );
        return $model;
    }

    /**
     * @return Webguys_Easytemplate_Block_Input_Renderer_Abstract
     */
    public function getInputRenderer()
    {
        $template = $this->getTemplate();
        $name = $template->getCode().'_'.$this->getCode();

        /** @var $block Webguys_Easytemplate_Block_Input_Renderer_Abstract */
        $block = Mage::app()->getLayout()->createBlock(
            $this->getBackendModelAlias( $this->getData('input_renderer') ),
            'easytemplate_template_field_'.$name
        );
        $block->setParentParserField( $this );
        $block->setCode( $this->getCode() );
        $block->setLabel( $this->getLabel() );
        $block->setComment( $this->getComment() );
        $block->setDefault( $this->getDefaultValue() );
        $block->setRequired( $this->getRequired() );
        $block->setSource( $this->getInputRendererSource() );

        return $block;
    }

    public function getInputRendererSource()
    {
        $inputRenderer = $this->getData('input_renderer_source');
        return $inputRenderer ? Mage::getModel($inputRenderer) : false;
    }

}