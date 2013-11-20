<?php

/**
 * Class Webguys_Easytemplate_Model_Input_Parser_Template
 *
 * @method setCategory
 * @method getCategory
 *
 */
class Webguys_Easytemplate_Model_Input_Parser_Template
 extends Webguys_Easytemplate_Model_Input_Parser_Abstract
{

    public function isEnabled()
    {
        return (bool)$this->getData('enabled');
    }

    public function getLabel()
    {
        return $this->getData('label');
    }

    public function getComment()
    {
        return $this->getData('comment');
    }

    public function getTemplate()
    {
        return $this->_getAttribute('template');
    }

    public function getType()
    {
        return $this->_getAttribute('type');
    }

    protected function _getAttribute($name)
    {
        return $this->getConfig()->getNode()->getAttribute($name);
    }

    /**
     * @return Webguys_Easytemplate_Model_Input_Parser_Field[]
     */
    public function getFields()
    {
        $fields = $this->getConfig()->getNode('fields');
        $result = array();

        foreach( $fields->children() AS $data )
        {
            /** @var $parser Webguys_Easytemplate_Model_Input_Parser_Field */
            $parser = Mage::getModel('easytemplate/input_parser_field');
            $parser->setConfig( $data );
            $parser->setTemplate( $this );

            $result[] = $parser;
        }

        return $result;
    }

    public function getCode()
    {
        return $this->getCategory() .'_'.parent::getCode();
    }

}