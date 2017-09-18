<?php

/**
 * Class Webguys_Easytemplate_Model_Cms_Block
 *
 * Workaround, because Mage_Cms_Model_Block has no eventPrefix (core issue)
 * Used for event handling
 *
 */
class Webguys_Easytemplate_Model_Cms_Block extends Mage_Cms_Model_Block
{
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'cms_block';
}
