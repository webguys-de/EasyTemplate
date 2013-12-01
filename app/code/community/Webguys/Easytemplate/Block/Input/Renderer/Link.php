<?php

/**
 * Class Webguys_Easytemplate_Block_Input_Renderer_File
 *
 */
class Webguys_Easytemplate_Block_Input_Renderer_Link extends Webguys_Easytemplate_Block_Input_Renderer_Abstract
{

    // TODO: Clean up code

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('easytemplate/input/renderer/link.phtml');
    }

    public function getDefaultBackendModel()
    {
        return Mage::getModel('easytemplate/template_data_varchar');
    }

    public function getEntityCode()
    {
        $code = current( explode('/', $this->getValue() ) );
        if( $code == 'product' )
        {
            return 'product';
        } else if( $code == 'category' )
        {
            return 'category';
        } else if( is_numeric( $this->getValue() ) )
        {
            return 'cms';
        }

        return null;
    }

    /**
     * @return Varien_Object
     */
    public function getEntityModel()
    {
        if( $this->getEntityCode() == 'product' )
        {
            $model = Mage::getModel('catalog/product');
            $model->load( $this->getEntityId() );
            return $model;
        }

        if( $this->getEntityCode() == 'category' )
        {
            $model = Mage::getModel('catalog/category');
            $model->load( $this->getEntityId() );
            return $model;
        }

        if( $this->getEntityCode() == 'cms' )
        {
            $model = Mage::getModel('cms/page');
            $model->load( $this->getEntityId() );
            return $model;
        }

        return new Varien_Object();
    }

    public function getName()
    {
        $model = $this->getEntityModel();

        if( $this->getEntityCode() == 'product' )
        {

            return '<div class="hover"><strong>#</strong>'.$model->getId().'</strong>: '. $model->getName() . '<span class="tooltip">' . $this->__('Sku') . ': ' . $model->getSku() . '</span></div>';

            //return '<a class="tooltips" href="#"><strong>#</strong>'.$model->getId().'</strong>: '. $model->getName() . '<span>' . $this->__('Sku') . ': ' . $model->getSku() . '</span></a>';
        } else if( $this->getEntityCode() == 'cms' ) {
            return '<strong>#'.$model->getId().'</strong>: '.$model->getTitle();
        }

        return '<strong>#'.$model->getId().'</strong>: '.$model->getName();
    }

    public function getEntityId()
    {
        if( $this->getEntityCode() == 'cms' )
        {
            return $this->getValue();
        }

        return end( explode('/', $this->getValue() ) );
    }
}