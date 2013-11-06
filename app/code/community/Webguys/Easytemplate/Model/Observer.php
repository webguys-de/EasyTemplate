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

    public function controller_action_predispatch_adminhtml_cms_page_save($observer)
    {
        /** @var $controller Mage_Adminhtml_Cms_PageController */
        $controller = $observer->getControllerAction();

        $templatedata = $controller->getRequest()->getPost('template');

        if (is_array( $templatedata ) ) {
            // TODO: Creating new page could not work
            $group = Mage::helper('easytemplate')->getGroupByPageId( $controller->getRequest()->getPost('page_id') );

            /** @var $group Webguys_Easytemplate_Model_Group */
            $group->importData( $templatedata );
        }
    }

    public function controller_action_layout_generate_blocks_after($observer)
    {
        $action = $observer->getAction();

        if ($action instanceof Mage_Cms_PageController) {

            $layout = $action->getLayout();

            if ($block = $layout->getBlock('cms_page')) {
                $parent = $block->getParentBlock();
                $layout->unsetBlock('cms_page');

                $parent->setChild('cms_page',
                    $layout->createBlock('easytemplate/frontend_renderer', 'cms_page')
                );
            }

        }

    }
}