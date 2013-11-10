<?php

/**
 * Class Webguys_Easytemplate_Model_Template_Data_Varchar
 *
 */
class Webguys_Easytemplate_Model_Template_Data_Varchar
    extends Webguys_Easytemplate_Model_Template_Data_Abstract
{

    protected function _construct()
    {
        $this->_init('easytemplate/template_data_varchar');
    }

    /**
     * Import data with support for arrays (multiselect values)
     *
     * @param $data
     */
    public function importData( $data )
    {
        if (is_array($data)) {
            $data = join(',', $data);
        }
        parent::importData($data);
    }

}