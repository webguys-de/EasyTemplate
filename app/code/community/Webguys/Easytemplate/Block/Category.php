<?php

class Webguys_Easytemplate_Block_Category extends Webguys_Easytemplate_Block_Renderer
{

    public function _construct()
    {

        /** @var $category Mage_Catalog_Model_Category */
        $category = Mage::registry('current_category');

        /** @var $helper Webguys_Easytemplate_Helper_Category */
        $helper = Mage::helper('easytemplate/category');

        if ( $groupId = $helper->getGroupByCategoryId( $category->getId() ) ) {
            /** @var $renderer Webguys_Easytemplate_Block_Renderer */
            $this->setGroupId( $groupId );
        }

        return parent::_construct();
    }



}