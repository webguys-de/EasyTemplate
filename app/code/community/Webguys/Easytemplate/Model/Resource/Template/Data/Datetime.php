<?php

/**
 * Class Webguys_Easytemplate_Model_Resource_Template_Data_Datetime
 *
 */
class Webguys_Easytemplate_Model_Resource_Template_Data_Datetime
    extends Webguys_Easytemplate_Model_Resource_Template_Data_Abstract
{
    public function _construct()
    {
        $this->_init('easytemplate/template_data_datetime', 'id');
    }
}