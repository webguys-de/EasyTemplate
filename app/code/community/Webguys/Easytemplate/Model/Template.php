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

    protected function _construct()
    {
        $this->_init('easytemplate/template');
    }

    public function importData( Array $data)
    {
        $this->setCode( $data['code'] );
        $this->setName( $data['name'] );

        // TODO: Other Fields

        $this->_field_data = $data['fields'];

    }

    public function _afterSave()
    {
        /** @var $configModel Webguys_Easytemplate_Model_Input_Parser */
        $configModel = Mage::getSingleton('easytemplate/input_parser');

        if ($model = $configModel->getTemplate( $this->getCode() )) {

            foreach ($model->getFields() as $field) {

                $backendModel = $field->getBackendModel();
                $backendModel->importData( $this->_field_data[ $field->getCode() ] );
                $backendModel->setElementId( $this->getId() ); // TODO: Change naming to template!!
                $backendModel->save();

            }

        }
    }

    public function getFields()
    {
        $configModel = Mage::getSingleton('easytemplate/input_parser');
        if ($model = $configModel->getTemplate( $this->getCode() )) {
            return $model->getFields();
        }
    }

}