<?php

class Webguys_Easytemplate_Block_Template extends Mage_Core_Block_Template
{
    /**
     * @var Varien_Object
     */
    protected $_templateVars = null;

    public function __construct()
    {
        parent::_construct();

        $this->_templateVars = new Varien_Object();
    }

    public function setTemplateVar($key, $value = null)
    {
        $this->_templateVars->setData($key, $value);
    }

    public function getTemplateVar($key = '')
    {
        return $this->_templateVars->getData($key);
    }

    /**
     * Returns a list of all template identifiers
     */
    public function getTemplateVarList()
    {
        return array_keys($this->_templateVars->getData());
    }
}