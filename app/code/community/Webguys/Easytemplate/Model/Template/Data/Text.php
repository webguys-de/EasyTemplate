<?php

/**
 * Class Webguys_Easytemplate_Model_Template_Data_Text
 *
 */
class Webguys_Easytemplate_Model_Template_Data_Text
    extends Webguys_Easytemplate_Model_Template_Data_Abstract
{
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'easytemplate_template_data_text';

    protected function _construct()
    {
        $this->_init('easytemplate/template_data_text');
    }
}