<?php

/**
 * Class Webguys_Easytemplate_Model_Template_Data_Abstract
 *
 */
abstract class Webguys_Easytemplate_Model_Template_Data_Abstract
    extends Mage_Core_Model_Abstract
{

    protected $_parent_parser_field = null;

    public function setParentParserField($field)
    {
        $this->_parent_parser_field = $field;
        return $this;
    }

    /**
     * @return Webguys_Easytemplate_Model_Input_Parser_Abstract
     */
    public function getParentParserField()
    {
        return $this->_parent_parser_field;
    }

    public function importData( $data )
    {
        $this->setField( $this->getParentParserField()->getCode() );
        $this->setValue( $data );
    }

    public function getInternalName()
    {
        return get_class( $this );
    }

}