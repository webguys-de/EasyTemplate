<?php

/**
 * Class Webguys_Easytemplate_Model_Template_Data_Varchar
 *
 */
class Webguys_Easytemplate_Model_Template_Data_Varchar
    extends Webguys_Easytemplate_Model_Template_Data_Abstract
{
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'easytemplate_template_data_varchar';

    protected function _construct()
    {
        $this->_init('easytemplate/template_data_varchar');
    }

    public function isValid()
    {
        return (strlen($this->getValue()) <= 255);
    }
}
