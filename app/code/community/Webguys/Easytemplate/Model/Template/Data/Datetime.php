<?php

/**
 * Class Webguys_Easytemplate_Model_Template_Data_Datetime
 *
 */
class Webguys_Easytemplate_Model_Template_Data_Datetime extends Webguys_Easytemplate_Model_Template_Data_Abstract
{
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'easytemplate_template_data_datetime';

    protected function _construct()
    {
        $this->_init('easytemplate/template_data_datetime');
    }

    public function isValid()
    {
        return (strtotime($this->getValue()) !== false);
    }
}
