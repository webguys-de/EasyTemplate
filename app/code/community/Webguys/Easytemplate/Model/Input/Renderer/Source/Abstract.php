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

    private function translate(&$item)
    {
        /** @var $helper Webguys_Easytemplate_Helper_Data */
        $helper = Mage::helper('easytemplate');
        $item = $helper->__($item);
    }

    protected function translateOptions($options)
    {
        if (!is_array($options)) {
            throw new Exception('Unable to translate options - no array defined');
        }

        array_walk($options, array($this, 'translate'));
        return $options;
    }

    abstract public function getOptionValues();
}