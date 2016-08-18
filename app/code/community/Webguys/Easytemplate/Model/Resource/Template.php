<?php

/**
 * Class Webguys_Easytemplate_Model_Resource_Template
 *
 * @method getBlockId
 * @method setBlockId
 * @method getCode
 * @method setCode
 * @method getName
 * @method setName
 * @method getActive
 * @method setActive
 * @method getPosition
 * @method setPosition
 * @method getValidFrom
 * @method setValidFrom
 * @method getValidTo
 * @method setValidTo
 *
 */
class Webguys_Easytemplate_Model_Resource_Template
    extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('easytemplate/template', 'id');
    }

    /**
     * @param Webguys_Easytemplate_Model_Template $object
     * @return Mage_Core_Model_Resource_Db_Abstract
     */
    protected function _afterLoad(Mage_Core_Model_Abstract $object)
    {
        // TODO: Solve this workaround
        if ($object->getValidFrom()) {
            $object->setValidFrom(date('Y-m-d', strtotime($object->getValidFrom())));
        }

        if ($object->getValidTo()) {
            $object->setValidTo(date('Y-m-d', strtotime($object->getValidTo())));
        }

        return parent::_afterLoad($object);
    }
}