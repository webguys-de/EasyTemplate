<?php

/**
 * Class Webguys_Easytemplate_Model_Config_Source_Cms_Page_Viewmode
 *
 */
class Webguys_Easytemplate_Model_Config_Source_Cms_Page_Viewmode
{
    const VIEWMODE_CORE = 'core';
    const VIEWMODE_EASYTPL = 'easytemplate';

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => self::VIEWMODE_CORE, 'label' => Mage::helper('easytemplate')->__('Standard')),
            array('value' => self::VIEWMODE_EASYTPL, 'label' => Mage::helper('easytemplate')->__('Easy template')),
        );
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            self::VIEWMODE_CORE => Mage::helper('easytemplate')->__('Standard'),
            self::VIEWMODE_EASYTPL => Mage::helper('easytemplate')->__('Easy template'),
        );
    }
}
