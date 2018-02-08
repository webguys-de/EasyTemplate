<?php

/**
 * Class Webguys_Easytemplate_Block_Input_Renderer_File
 *
 */
class Webguys_Easytemplate_Block_Input_Renderer_Product extends Webguys_Easytemplate_Block_Input_Renderer_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('easytemplate/input/renderer/product.phtml');
    }

    public function getDefaultBackendModel()
    {
        return Mage::getModel('easytemplate/template_data_int');
    }

    /**
     * @return Mage_Catalog_Model_Product
     */
    public function getEntityModel()
    {
        $model = Mage::getModel('catalog/product');
        $model->load($this->getEntityId());
        return $model;
    }

    public function getName()
    {
        $model = $this->getEntityModel();
        if (!$model->getId()) {
            return '-';
        }

        return '#' . $model->getId() . ': ' . $model->getSku() . ' - ' . $model->getName();
    }

    public function getEntityId()
    {
        return $this->getValue();
    }
}
