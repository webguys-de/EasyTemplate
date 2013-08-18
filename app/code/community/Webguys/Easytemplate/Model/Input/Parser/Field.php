<?php

/**
 * Class Webguys_Easytemplate_Model_Input_Parser_Field
 *
 * @method getLabel
 * @method getSortOrder
 * @method getDefaultValue
 * @method getComment
 * @method getRequired
 */
class Webguys_Easytemplate_Model_Input_Parser_Field extends Webguys_Easytemplate_Model_Input_Parser_Abstract
{

    public function getBackendModelAlias( $name )
    {
        if ( strpos($name, '/') === false )
        {
            $name = 'easytemplate/template_data_'. $name;
        }

        return $name;
    }

    public function getInputRenderAlias( $name )
    {
        if ( strpos($name, '/') === false )
        {
            $name = 'easytemplate/input_renderer_'. $name;
        }

        return $name;
    }

    public function getCode()
    {
        return $this->getConfig()->getNode()->getName();
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
        $block = Mage::app()->getLayout()->createBlock(
            $this->getBackendModelAlias( $this->getData('input_renderer') )
        );
        $block->setParentParserField( $this );

        return $block;
    }

}