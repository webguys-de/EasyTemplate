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
    protected $_layer = null;

    public function getLayer()
    {
        if (!$this->_layer) {
            $this->_layer = Mage::getModel('catalog/layer');
        }
        return $this->_layer;
    }

    public function _getProductCollection()
    {
        // Repair frontend renderer: Webguys/Easytemplate/Model/Input/Renderer/Validator/Category.php:9
        $categoryId = $this->getCategoryId();
        if ($categoryId && $categoryId instanceof Mage_Catalog_Model_Category) {
            $this->setData('category_id', $categoryId->getId());
        }

        if ($this->getSkuList()) {
            $collection = Mage::getModel('catalog/product')->getCollection();
            $layer = $this->getLayer();
            $layer->prepareProductCollection($collection);
        } else {
            $collection = parent::_getProductCollection();
        }

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
                $select->where('e.sku IN (?)', $skus);

                $escapedSkus = array();
                foreach ($skus as $sku) {
                    $escapedSkus[] = $collection->getConnection()->quote($sku);
                }
                $select->order(new Zend_Db_Expr('FIELD(e.sku, ' . join(',', $escapedSkus) . ')'));
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