<?php

/**
 * Class Webguys_Easytemplate_Model_Input_Parser_Abstract
 *
 */
abstract class Webguys_Easytemplate_Model_Input_Parser_Abstract extends Varien_Object
{
    /** @var Varien_Simplexml_Config */
    protected $_config;

    public function setConfig(Varien_Simplexml_Element $data)
    {
        $this->_config = new Varien_Simplexml_Config($data);
    }

    /** @return Varien_Simplexml_Config */
    public function getConfig()
    {
        if( !$this->_config ) {
            $this->_config = new Varien_Simplexml_Config();
        }
        return $this->_config;
    }

    public function getData($key = '', $index = null)
    {
        if ($this->getConfig()) {
            $parent = parent::getData($key, $index);
            return $parent ? $parent : (string)$this->getConfig()->getNode($key);
        }
        return null;
    }

    public function getCode()
    {
        return $this->getConfig()->getNode()->getName();
    }
}