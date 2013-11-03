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

    public function getLabel()
    {
        return $this->getData('label');
    }

    public function getComment()
    {
        return $this->getData('comment');
    }

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

}