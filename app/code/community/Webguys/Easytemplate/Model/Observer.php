<?php

/**
 * Class Webguys_Easytemplate_Model_Observer
 *
 */
class Webguys_Easytemplate_Model_Observer extends Mage_Core_Model_Abstract
{
    /**
     * Adds view mode to cms_page and cms_block
     *
     * @param $observer
     */
    public function adminhtml_cms_prepare_form($observer)
    {
        $form = $observer->getForm();

        foreach ($form->getElements() as $element) {
            if ($element instanceof Varien_Data_Form_Element_Fieldset) {

                /** @var $sourceModel Webguys_Easytemplate_Model_Config_Source_Cms_Page_Viewmode */
                $sourceModel = Mage::getModel('easytemplate/config_source_cms_page_viewmode');

                /** @var $element Varien_Data_Form_Element_Fieldset */
                $element->addField('view_mode', 'select', array(
                    'label'     => Mage::helper('easytemplate')->__('Mode'),
                    'title'     => Mage::helper('easytemplate')->__('View Mode'),
                    'name'      => 'view_mode',
                    'required'  => true,
                    'options'   => $sourceModel->toArray(),
                    'note'      => Mage::helper('easytemplate')->__('Use the template engine or default behavior'),
                    'disabled'  => false,
                    'onchange'  => "if($('page_tabs_content_section')) { if(this.value=='easytemplate') { $('page_tabs_content_section').hide(); $('page_content').removeClassName('required-entry'); } else { $('page_tabs_content_section').show(); $('page_content').addClassName('required-entry'); } }"
                ));
            }
        }
    }

    public function cms_page_save_commit_after($observer)
    {
        /** @var $page Mage_Cms_Model_Page */
        $page = $observer->getDataObject();

        /** @var $group Webguys_Easytemplate_Model_Group */
        $group = Mage::helper('easytemplate/page')->getGroupByPageId( $page->getId() );

        /** @var $helper Webguys_Easytemplate_Helper_Data */
        $helper = Mage::helper('easytemplate');
        $helper->saveTemplateInformation($group);
    }

    public function cms_block_save_commit_after($observer)
    {
        /** @var $block Mage_Cms_Model_Block */
        $block = $observer->getDataObject();

        /** @var $group Webguys_Easytemplate_Model_Group */
        $group = Mage::helper('easytemplate/block')->getGroupByBlockId( $block->getId() );

        /** @var $helper Webguys_Easytemplate_Helper_Data */
        $helper = Mage::helper('easytemplate');
        $helper->saveTemplateInformation($group);
    }

    public function core_block_abstract_to_html_before( $event )
    {
        /** @var $block Mage_Catalog_Block_Category_View */
        $block = $event->getBlock();
        if ( $block instanceof Mage_Catalog_Block_Category_View )
        {
            /** @var $category Mage_Catalog_Model_Category */
            $category = Mage::registry('current_category');

            /** @var $helper Webguys_Easytemplate_Helper_Category */
            $helper = Mage::helper('easytemplate/category');

            if( $category->getUseEasytemplate() )
            {
                if ( $group = $helper->getGroupByCategoryId( $category->getId(), Mage::app()->getStore()->getId(), true ) )
                {
                    // Override display mode if not configured correctly

                    /** @var $curCategory Mage_Catalog_Model_Category */
                    $curCategory = $block->getCurrentCategory();
                    if ($curCategory->getDisplayMode() == Mage_Catalog_Model_Category::DM_PRODUCT) {
                        $curCategory->setDisplayMode(Mage_Catalog_Model_Category::DM_MIXED);
                    }

                    // Replace original category content
                    /** @var $renderer Webguys_Easytemplate_Block_Renderer */
                    $renderer = Mage::app()->getLayout()->createBlock('easytemplate/renderer', 'easytemplate_category');
                    $renderer->setGroup( $group );
                    $renderer->setParentBlock($block);

                    $block->setCmsBlockHtml( $renderer->toHtml() );
                }
            }
        }
    }

    public function cms_page_render($observer)
    {
        /** @var Mage_Core_Controller_Varien_Action $action */
        $action = $observer->getControllerAction();

        /** @var Mage_Cms_Model_Page $page */
        $page = $observer->getPage();

        /** @var $helper Webguys_Easytemplate_Helper_Page */
        $helper = Mage::helper('easytemplate/page');

        if ($helper->isEasyTemplatePage($page->getId()) )
        {
            $action->getLayout()->getUpdate()->addHandle('cms_easytemplate');
        }
    }

    public function core_block_abstract_to_html_after($observer)
    {
        /** @var $block Mage_Core_Block_Abstract */
        $block = $observer->getBlock();

        /** @var $transport Varien_Object */
        $transport = $observer->getTransport();

        if ($block instanceof Mage_Cms_Block_Page ) {

            /** @var $block Mage_Cms_Block_Page  */
            $pageId = $block->getPage()->getId();

            /** @var $helper Webguys_Easytemplate_Helper_Page */
            $helper = Mage::helper('easytemplate/page');

            if ($pageId !== false && $helper->isEasyTemplatePage($pageId)) {
                $html = '';

                if ( $group = $helper->getGroupByPageId( $pageId ) ) {
                    /** @var $renderer Webguys_Easytemplate_Block_Renderer */
                    $renderer = Mage::app()->getLayout()->createBlock('easytemplate/renderer');
                    $renderer->setGroup( $group );
                    $renderer->setParentBlock($block);
                    $html = $renderer->toHtml();
                }

                $transport->setHtml( $html );
            }

        } elseif ($block instanceof Mage_Cms_Block_Block) {

            /** @var $block Mage_Cms_Block_Block  */
            $blockId = $block->getBlockId();

            /** @var $helper Webguys_Easytemplate_Helper_Block */
            $helper = Mage::helper('easytemplate/block');

            if ($blockId && ($InternalBlockId = $helper->isEasyTemplateBlock($blockId) ) ) {
                $html = '';

                if ( $group = $helper->getGroupByBlockId( $InternalBlockId ) ) {
                    /** @var $renderer Webguys_Easytemplate_Block_Renderer */
                    $renderer = Mage::app()->getLayout()->createBlock('easytemplate/renderer');
                    $renderer->setGroup( $group );
                    $renderer->setParentBlock($block);
                    $html = $renderer->toHtml();
                }

                $transport->setHtml( $html );
            }
        }

    }

    public function adminhtml_block_html_before($observer)
    {
        $block = $observer->getEvent()->getBlock();
        if ($block instanceof Mage_Adminhtml_Block_Cms_Page_Grid ||
            $block instanceof Mage_Adminhtml_Block_Cms_Block_Grid) {

            /** @var $sourceModel Webguys_Easytemplate_Model_Config_Source_Cms_Page_Viewmode */
            $sourceModel = Mage::getModel('easytemplate/config_source_cms_page_viewmode');

            $block->addColumnAfter(
                'view_mode',
                array(
                    'header' => Mage::helper('easytemplate')->__('Mode'),
                    'index' => 'view_mode',
                    'width' => '100px',
                    'header_css_class' => 'view_mode',
                    'sortable' => true,
                    'type' => 'options',
                    'options'  => $sourceModel->toArray(false),
                ),
                'root_template'
            );

        }
    }

    public function adminhtml_catalog_category_tabs( $observer )
    {
        /** @var $tabs Mage_Adminhtml_Block_Catalog_Category_Tabs */
        $tabs = $observer->getTabs();

        if (Mage::getStoreConfig('easytemplate/configuration/use_in_categories')) {
            $tabs->addTab('easytemplate', array(
                'label'     => Mage::helper('catalog')->__('Easy template'),
                'content'   => $tabs->getLayout()->getBlock('adminhtml_category_templates')->toHtml(),
            ));
        }
    }

    public function catalog_category_save_commit_after($observer)
    {
        /** @var $category Mage_Catalog_Model_Category */
        $category = $observer->getDataObject();

        /** @var $group Webguys_Easytemplate_Model_Group */
        $group = Mage::helper('easytemplate/category')->getGroupByCategoryId( $category->getId(), $category->getStoreId() );

        /** @var $helper Webguys_Easytemplate_Helper_Data */
        $helper = Mage::helper('easytemplate');
        $helper->saveTemplateInformation($group);
    }
}