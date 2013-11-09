<?php


class Webguys_Easytemplate_Model_Observer extends Mage_Core_Model_Abstract
{
    public function adminhtml_cms_page_edit_tab_main_prepare_form($observer)
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
                ));
            }
        }
    }

    public function cms_page_save_before($observer)
    {
        // TODO: Check validation
    }

    public function cms_page_save_after($observer)
    {
        /** @var $page Mage_Cms_Model_Page */
        $page = $observer->getDataObject();

        $request = Mage::app()->getRequest();
        $templatedata = $request->getPost('template');

        if (is_array( $templatedata ) ) {
            try {
                $group = Mage::helper('easytemplate/page')->getGroupByPageId( $page->getId() );

                /** @var $group Webguys_Easytemplate_Model_Group */
                $group->importData( $templatedata );
            } catch (Exception $e) {
                $page->_dataSaveAllowed = false;
                Mage::getSingleton('core/session')->addError($e->getMessage());
            }
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

            if ($pageId !== false && Mage::helper('easytemplate/page')->isEasyTemplatePage($pageId)) {
                $html = '';

                /** @var $helper Webguys_Easytemplate_Helper_Page */
                $helper = Mage::helper('easytemplate/page');

                if ( $groupId = $helper->getGroupByPageId( $pageId ) )
                {
                    /** @var $renderer Webguys_Easytemplate_Block_Frontend_Renderer */
                    $renderer = Mage::app()->getLayout()->createBlock('easytemplate/renderer');
                    $renderer->setGroupId( $groupId );
                    $html = $renderer->toHtml();
                }

                $transport->setHtml( $html );
            }

        }

    }
}