<?php

/**
 * Class Webguys_Easytemplate_Model_Template_Data_Int
 *
 */
class Webguys_Easytemplate_Model_Template_Data_Int
    extends Webguys_Easytemplate_Model_Template_Data_Abstract
{

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'easytemplate_template_data_int';

    protected function _construct()
    {
        $this->_init('easytemplate/template_data_int');
    }

}