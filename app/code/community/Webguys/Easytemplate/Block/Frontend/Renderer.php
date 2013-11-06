<?php

class Webguys_Easytemplate_Block_Frontend_Renderer extends Mage_Core_Block_Template
{
    protected function _beforeToHtml()
    {
        $pageId = $this->getRequest()->getParam('page_id', $this->getRequest()->getParam('id', false));

        $page = Mage::getSingleton('cms/page');
        $page->setStoreId(Mage::app()->getStore()->getId());
        $page->load($pageId);

        if ($page->getId() && $page->getViewMode() == Webguys_Easytemplate_Model_Config_Source_Cms_Page_Viewmode::VIEWMODE_EASYTPL) {

            /** @var $layout Mage_Core_Model_Layout */
            $layout = Mage::app()->getLayout();

            /** @var $helper Webguys_Easytemplate_Helper_Data */
            $helper = Mage::helper('easytemplate');
            $group = $helper->getGroupByPageId($page->getId());

            /** @var $configModel Webguys_Easytemplate_Model_Input_Parser */
            $configModel = Mage::getSingleton('easytemplate/input_parser');

            $baseBlock = $layout->createBlock(
                'core/template',
                'easytemplate_frontend_baseblock'
            );

            foreach ($group->getTemplateCollection() as $template) {
                if ($model = $configModel->getTemplate( $template->getCode() )) {
                    $childBlock = $this->getLayout()->createBlock($model->getType());
                    $childBlock->setTemplate($model->getTemplate());

                    //$childBlock->setData();

                    $this->setChild('block_'.$template->getCode(), $childBlock);
                }
            }

        }

        return parent::_beforeToHtml();
    }

    protected function _toHtml()
    {
        return $this->getChildHtml();
    }
}