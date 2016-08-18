<?php

/**
 * Class Webguys_Easytemplate_Model_Input_Renderer_Validator_Product
 *
 */
class Webguys_Easytemplate_Model_Input_Renderer_Validator_Product extends Webguys_Easytemplate_Model_Input_Renderer_Validator_Base
{
    public function prepareForFrontend($data)
    {
        /** @var $product Mage_Catalog_Model_Product */
        $product = Mage::getModel('catalog/product');
        $product->load($data);

        return ($product->getId()) ? $product : false;
    }

    public function prepareForSave($data)
    {
        if (is_numeric($data)) {
            return $data;
        }
        return end(explode('/', $data));
    }
}