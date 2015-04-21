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
 *
 * @method setSkuList
 * @method getSkuList
 * @method setSkuListSeparator
 * @method getSkuListSeparator
 */
class Webguys_Easytemplate_Block_Template_Product_List extends Mage_Catalog_Block_Product_List
{

    public function getLayer()
    {
        if ( !$this->_layer ) {
            $this->_layer = Mage::getModel( 'catalog/layer' );
        }
        return $this->_layer;
    }

    public function _getProductCollection()
    {
        $collection = parent::_getProductCollection();

        if ($this->getLimit()) {
            $collection->setPageSize($this->getLimit());
        }

        if ($this->getSortBy()) {
            $collection->setOrder($this->getSortBy(), $this->getSortByDirection());
        }

        if ($this->getSkuList()) {
            $select = $collection->getSelect();

            $separator = $this->getSeparator();
            if (empty($separator)) {
                $separator = ',';
            }
            $skus = explode($separator, $this->getSkuList());

            if (count($skus)) {
                $select->where('sku IN (?)', $skus);

                $escapedSkus = array();
                foreach ($skus AS $sku) {
                    $escapedSkus[] = $collection->getConnection()->quote($sku);
                }
                $select->order(new Zend_Db_Expr('FIELD(sku, ' . join(',', $escapedSkus) . ')'));
            } else {
                $select->where('SKU IS NULL');
            }
        }

        return $collection;
    }

    public function getToolbarHtml()
    {
        return null;
    }

}