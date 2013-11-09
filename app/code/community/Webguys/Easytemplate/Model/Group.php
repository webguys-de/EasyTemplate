<?php

/**
 * Class Webguys_Easytemplate_Model_Group
 *
 * @method setEntityType
 * @method getEntityType
 * @method setEntityId
 * @method getEntityId
 */
class Webguys_Easytemplate_Model_Group extends Mage_Core_Model_Abstract
{

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'easytemplate_group';

    protected function _construct()
    {
        $this->_init('easytemplate/group');
    }

    public function importData( $data )
    {
        if( !$this->getId() )
        {
            throw new Exception("Could not import data to empty entity");
        }

        foreach( $data AS $id => $template_data )
        {

            /** @var $template Webguys_Easytemplate_Model_Template */
            $template = Mage::getModel('easytemplate/template');
            if ( is_numeric( $id ) )
            {
                $template->load( $id );
            }
            $template->setGroupId( $this->getId() );

            if( $template_data['is_delete'] == '1' )
            {
                if( $template->getId() )
                {
                    $template->delete();
                }
            } else {
                $template->importData( $template_data );
                $template->save();
            }

        }

    }

    /**
     * @return Webguys_Easytemplate_Model_Template[]
     */
    public function getTemplateCollection()
    {
        /** @var $collection Webguys_Easytemplate_Model_Resource_Template_Collection */
        $collection = Mage::getModel('easytemplate/template')->getCollection();
        $collection->addGroupFilter($this);
        $collection->setOrder('position');

        foreach( $collection AS &$model )
        {
            $model->load( $model->getId() );
        }

        return $collection;
    }



}