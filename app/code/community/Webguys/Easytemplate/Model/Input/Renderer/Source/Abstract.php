<?php

/**
 * Class Webguys_Easytemplate_Model_Input_Renderer_Source_Abstract
 *
 */
abstract class Webguys_Easytemplate_Model_Input_Renderer_Source_Abstract extends Mage_Core_Model_Abstract
{
    protected $_parentField = null;

    /**
     * @return Webguys_Easytemplate_Model_Input_Parser_Field
     */
    public function getParentField()
    {
        return $this->_parentField;
    }

    /**
     * @param null $parentField
     */
    public function setParentField($parentField)
    {
        $this->_parentField = $parentField;
    }

    abstract public function getOptionValues();

}
