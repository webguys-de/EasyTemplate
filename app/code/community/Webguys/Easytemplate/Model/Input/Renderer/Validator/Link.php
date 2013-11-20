<?php

/**
 * Class Webguys_Easytemplate_Model_Input_Renderer_Validator_File
 *
 */
class Webguys_Easytemplate_Model_Input_Renderer_Validator_Link extends Webguys_Easytemplate_Model_Input_Renderer_Validator_Base
{
    protected $_deleteFile = false;

    public function prepareForFrontend($data)
    {

        list($code, $id ) = explode('/', $data);
        if( $code == 'product' )
        {
            // TODO: Wirklich so laden?
            $product = Mage::getModel('catalog/product');
            $product->load( $id );
            return $product->getProductUrl();
        }

        if( $code == 'category' )
        {
            // TODO: Wirklich so laden?

            /** @var $product Mage_Catalog_Model_Category */
            $category = Mage::getModel('catalog/category');
            $category->load( $id );
            return $category->getUrl();
        }

        if( is_numeric( $data ) )
        {
            return Mage::Helper('cms/page')->getPageUrl( $data );
        }

        if( substr($data, 0, 4 ) == 'http' || substr($data, 0, 1 ) == '.' || substr($data, 0, 1 ) == '/' )
        {
            // do not touch http or relative links
            return $data;
        }

        return Mage::getUrl( $data );
    }



}
