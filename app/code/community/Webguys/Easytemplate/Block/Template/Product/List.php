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
 *
 * @method getSortByDirection
 * @method setSortByDirection
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

        if( $this->getSortBy() )
        {
            $collection->setOrder( $this->getSortBy(), $this->getSortByDirection()  );
        }


        return $collection;
    }

    public function getToolbarHtml()
    {
        return null;
    }

}