<?php

/**
 * Class Webguys_Easytemplate_Block_Input_Renderer_Abstract
 *
 * @method getTemplateModel
 * @method setTemplateModel
 * @method getCode
 * @method setCode
 * @method getLabel
 * @method setLabel
 * @method getComment
 * @method setComment
 * @method getDefault
 * @method setDefault
 * @method getRequired
 * @method setRequired
 * @method getSource
 * @method setSource
 */
abstract class Webguys_Easytemplate_Block_Input_Renderer_Abstract extends Mage_Adminhtml_Block_Template
{
    /**
     * @var Webguys_Easytemplate_Model_Input_Parser_Field
     */
    protected $_parent_parser_field = null;
    protected $_value = null;

    public function setParentParserField($field)
    {
        $this->_parent_parser_field = $field;
    }

    public function getParentParserField()
    {
        return $this->_parent_parser_field;
    }

    public function setValue($value)
    {
        $this->_value = $value;
    }

    public function getValue()
    {
        if ($this->_value === null) {
            return $this->getDefault();
        }
        return $this->_value;
    }

    abstract public function getDefaultBackendModel();
}