<?php

/**
 * Class Webguys_Easytemplate_Model_Template_Data_Abstract
 *
 * @method getTemplateId
 * @method setTemplateId
 * @method getField
 * @method setField
 * @method getValue
 * @method setValue
 */
abstract class Webguys_Easytemplate_Model_Template_Data_Abstract
    extends Mage_Core_Model_Abstract
{
    protected $_parent_parser_field = null;

    public function setParentParserField($field)
    {
        $this->_parent_parser_field = $field;
        return $this;
    }

    /**
     * @return Webguys_Easytemplate_Model_Input_Parser_Abstract
     */
    public function getParentParserField()
    {
        return $this->_parent_parser_field;
    }

    public function importData($data)
    {
        $this->setField($this->getParentParserField()->getCode());
        $this->setValue($data);
    }

    public function getInternalName()
    {
        return get_class($this);
    }

    /**
     * Loads existing values for given template
     *
     * @param $template Webguys_Easytemplate_Model_Template
     * @return $this
     */
    public function loadByTemplate($template)
    {
        $fieldCode = $this->getParentParserField()->getCode();

        /** @var $collection Webguys_Easytemplate_Model_Resource_Template_Data_Collection_Abstract */
        $collection = $this->getCollection()
            ->addFieldToFilter('template_id', $template->getId())
            ->addFieldToFilter('field', $fieldCode)
            ->load();

        if ($collection->getSize() > 0) {
            $this->load($collection->setPageSize(1)->setCurPage(1)->getFirstItem()->getId());
        }

        return $this;
    }

    /**
     * Checks if provided data is valid
     * Will be overwritten by child classes to implement specific behaviour
     *
     * @return bool
     */
    public function isValid()
    {
        return true;
    }
}
