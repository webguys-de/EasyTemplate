<?php

/**
 * Class Webguys_Easytemplate_Block_Input_Renderer_Datepicker
 *
 */
class Webguys_Easytemplate_Block_Input_Renderer_Datepicker extends Webguys_Easytemplate_Block_Input_Renderer_Select
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('easytemplate/input/renderer/datepicker.phtml');
    }

    public function getDefaultBackendModel()
    {
        return Mage::getModel('easytemplate/template_data_datetime');
    }

    /**
     * Retrieve locale
     *
     * @return Mage_Core_Model_Locale
     */
    public function getLocale()
    {
        if (!$this->_locale) {
            $this->_locale = Mage::app()->getLocale();
        }
        return $this->_locale;
    }

    public function getDateStrFormat()
    {
        return $this->getLocale()->getDateStrFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
    }

    public function getValue()
    {
        $value = parent::getValue();
        return strftime($this->getDateStrFormat(), strtotime($value));
    }
}
