<?php

/**
 * Class Webguys_Easytemplate_Model_Resource_Template_Data_Abstract
 *
 * @method getTemplateId
 * @method getField
 * @method getValue
 */
abstract class Webguys_Easytemplate_Model_Resource_Template_Data_Abstract extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _beforeSave(Mage_Core_Model_Abstract $object)
    {
        // Object validation - null values allowed
        if ($object instanceof Webguys_Easytemplate_Model_Template_Data_Abstract &&
            !is_null($object->getValue()) && !$object->isValid()
        ) {
            throw new Exception('Form data not valid');
        }
        return parent::_beforeSave($object);
    }
}
