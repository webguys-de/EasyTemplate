<?php

/**
 * Class Webguys_Easytemplate_Block_Template_Product_Skulist
 *
 * @method setSkuList
 * @method getSkuList
 * @method setSeparator
 * @method getSeparator
 */
class Webguys_Easytemplate_Block_Template_Product_Skulist extends Webguys_Easytemplate_Block_Template
{
    public function getProductListBlock($skuList, $separator = ',')
    {
        /** @var $productList Webguys_Easytemplate_Block_Template_Product_List */
        $productList = $this->getLayout()->createBlock('easytemplate/template_product_list');

        $productList->setTemplate('catalog/product/list.phtml');

        $productList->setSkuList($skuList);
        $productList->setSkuListSeparator($separator);

        return $productList;
    }
}