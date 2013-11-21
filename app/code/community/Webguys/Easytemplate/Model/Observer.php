<?php

/**
 * Class Webguys_Easytemplate_Model_Observer
 *
 */
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

    public function cms_page_save_commit_after($observer)
    {
        /** @var $page Mage_Cms_Model_Page */
        $page = $observer->getDataObject();

        $request = Mage::app()->getRequest();
        $templatedata = $request->getPost('template');

        if (is_array( $templatedata ) ) {
            /** @var $group Webguys_Easytemplate_Model_Group */
            $group = Mage::helper('easytemplate/page')->getGroupByPageId( $page->getId() );

            // Merge file information of $_FILES to $_POST
            if (isset($_FILES['template']['name']) && is_array($_FILES['template']['name'])) {
                foreach($_FILES['template']['name'] as $templateId => $data) {
                    if (is_array($data)) {
                        foreach ($data['fields'] as $fieldName => $field) {
                            $templatedata[$templateId]['fields'][$fieldName] = array('value' => $field);
                        }
                    }
                }
            }

            $group->importData( $templatedata );
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

                if ( $groupId = $helper->getGroupByPageId( $pageId ) ) {
                    /** @var $renderer Webguys_Easytemplate_Block_Frontend_Renderer */
                    $renderer = Mage::app()->getLayout()->createBlock('easytemplate/renderer');
                    $renderer->setGroupId( $groupId );
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
}