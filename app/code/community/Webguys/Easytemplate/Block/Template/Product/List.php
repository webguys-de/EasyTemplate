<?php

/**
 * Class Webguys_Easytemplate_Block_Template_Product_List
 *
 * @method getCategoryId
 * @method setCategoryId
 *
 * @method getLimit
 * @method setLimit
 *
 * @method getSortBy
 * @method setSortBy
 */
class Webguys_Easytemplate_Block_Template_Product_List extends Mage_Catalog_Block_Product_List
{

    public function _getProductCollection()
    {
        $collection = parent::_getProductCollection();

        if( $this->getLimit() )
        {
            $collection->setPageSize( $this->getLimit() );
        }

        return $collection;
    }

    public function getToolbarHtml()
    {
        return null;
    }

}