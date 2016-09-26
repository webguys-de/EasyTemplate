<?php

/**
 * Class Webguys_Easytemplate_Model_Template
 *
 * @method setGroupId
 * @method getGroupId
 * @method setCode
 * @method getCode
 * @method setName
 * @method getName
 * @method setLabel
 * @method getLabel
 * @method setActive
 * @method getActive
 * @method setPosition
 * @method getPosition
 * @method setValidFrom
 * @method getValidFrom
 * @method setValidTo
 * @method getValidTo
 */
class Webguys_Easytemplate_Model_Template extends Mage_Core_Model_Abstract
{
    protected $_field_data;
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'easytemplate_template';

    /**
     * $field_data = array(
     *      $code => $value
     * );
     */

    protected function _construct()
    {
        $this->_init('easytemplate/template');
    }

    /**
     * @return Webguys_Easytemplate_Model_Template
     */
    public function duplicate($group_id)
    {
        /** @var Webguys_Easytemplate_Model_Template $clone */
        $clone = clone $this;
        $clone->setId(null);
        $clone->setIsDuplicate(true);
        $clone->setGroupId($group_id);
        $clone->save();

        $source = Mage::helper('easytemplate/file')->getDestinationFilePath($this->getGroupId(), $this->getId());
        $dest = Mage::helper('easytemplate/file')->getDestinationFilePath($clone->getGroupId(), $clone->getId());

        if (file_exists($source)) {
            mkdir($dest, 0777, true);
            foreach (glob($source . '/*') as $source_file) {
                copy($source_file, $dest . DS . basename($source_file));
            }
        }

        return $clone;
    }

    protected function _beforeDelete()
    {
        if ($this->getId()) {
            $col = $this->getCollection()->addFieldToFilter('parent_id', $this->getId());

            foreach ($col as $item) {
                $item->delete();
            }
        }

        return parent::_beforeDelete();
    }

    public function importData(array $data)
    {
        $this->setCode($data['code']);
        $this->setName($data['name']);
        $this->setActive(isset($data['active']) ? $data['active'] : 0);
        $this->setPosition($data['sort_order']);

        if (is_numeric($data['parent_id']) && $data['parent_id'] > 0) {
            $this->setParentId($data['parent_id']);
        } else {
            $this->setParentId(null);
        }

        if (($time = strtotime($data['valid_from'])) !== false) {
            $this->setValidFrom(date('Y-m-d', $time));
        }

        if (($time = strtotime($data['valid_to'])) !== false) {
            $this->setValidTo(date('Y-m-d', $time));
        }

        if (array_key_exists('fields', $data)) {
            $this->_field_data = $data['fields'];
        } else {
            $this->_field_data = array();
        }
    }

    protected function _isValid()
    {
        $code = $this->getCode();
        return (isset($code));
    }

    protected function _beforeSave()
    {
        if (!$this->_isValid()) {
            $this->_dataSaveAllowed = false;
            throw new Exception('Required template data missing');
        }

        return parent::_beforeSave();
    }

    public function _afterSave()
    {
        /** @var $configModel Webguys_Easytemplate_Model_Input_Parser */
        $configModel = Mage::getSingleton('easytemplate/input_parser');

        if ($model = $configModel->getTemplate($this->getCode())) {

            foreach ($model->getFields() as $field) {

                $inputValidator = $field->getInputRendererValidator();
                $inputValidator->setTemplate($this);
                $inputValidator->setField($field);

                $value = $this->_field_data[$field->getCode()];
                if (!$this->getIsDuplicate()) {
                    $value = $inputValidator->prepareForSave($value);
                }

                $backendModel = $field->getBackendModel();
                $backendModel->loadByTemplate($this);

                $value = $inputValidator->beforeFieldSave($value, $backendModel->getValue());

                $backendModel->importData($value);
                $backendModel->setTemplateId($this->getId());

                $backendModel->save();
                $inputValidator->afterFieldSave($value);
            }
        }
    }

    /**
     * @return Webguys_Easytemplate_Model_Input_Parser_Template
     */
    public function getConfig()
    {
        /** @var $configModel Webguys_Easytemplate_Model_Input_Parser */
        $configModel = Mage::getSingleton('easytemplate/input_parser');
        if ($model = $configModel->getTemplate($this->getCode())) {
            return $model;
        }
        return Mage::getModel('easytemplate/input_parser_template');
    }

    public function getFields()
    {
        return $this->getConfig()->getFields();
    }

    public function _afterLoad()
    {
        /** @var $helper Webguys_Easytemplate_Helper_Data */
        $helper = Mage::helper('easytemplate');

        /** @var $models Webguys_Easytemplate_Model_Template_Data_Abstract[] */
        $models = array();

        $this->setLabel($helper->__($this->getConfig()->getLabel()));

        // collect all input-resources
        foreach ($this->getFields() as $field) {
            $backend_model_name = $field->getBackendModel()->getInternalName();
            $models[$backend_model_name] = $field->getBackendModel();
        }

        // iterate all models and get data using collections
        foreach ($models as $backend_model) {
            /** @var $data_collection Webguys_Easytemplate_Model_Resource_Template_Data_Collection_Abstract */
            $data_collection = $backend_model->getCollection();
            $data_collection->addTemplateFilter($this);

            /** @var $data Webguys_Easytemplate_Model_Resource_Template_Data_Abstract */
            foreach ($data_collection as $data) {
                $this->_field_data[$data->getField()] = $data->getValue();
            }
        }

        return $this;
    }

    public function getFieldData($field = null)
    {
        if ($field === null) {
            return $this->_field_data;
        }
        return $this->_field_data[$field];
    }
}