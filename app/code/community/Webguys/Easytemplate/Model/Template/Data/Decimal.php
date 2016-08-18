<?php

/**
 * Class Webguys_Easytemplate_Model_Template_Data_Decimal
 *
 */
class Webguys_Easytemplate_Model_Template_Data_Decimal
    extends Webguys_Easytemplate_Model_Template_Data_Abstract
{
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'easytemplate_template_data_decimal';

    protected function _construct()
    {
        $this->_init('easytemplate/template_data_decimal');
    }

    public function isValid()
    {
        return is_numeric($this->getValue());
    }
}