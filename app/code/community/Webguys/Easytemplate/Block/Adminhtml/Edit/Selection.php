<?php

/**
 * Class Webguys_Easytemplate_Block_Adminhtml_Edit_Selection
 *
 * @method getCategory
 * @method getCode
 */
class Webguys_Easytemplate_Block_Adminhtml_Edit_Selection extends Mage_Core_Block_Template
{
    const TEMPLATE_TYPES_PATH = 'easytemplate';

    public function getTemplates()
    {
        $categories = array();

        /** @var $helper Webguys_Easytemplate_Helper_Data */
        $helper = Mage::helper('easytemplate');

        /** @var $configModel Webguys_Easytemplate_Model_Input_Parser */
        $configModel = Mage::getSingleton('easytemplate/input_parser');

        foreach ($configModel->getCategories() as $category) {
            $types = array();

            foreach ($configModel->getTemplatesOfCategory($category) as $template) {
                $types[] = array(
                    'label' => $helper->__($template->getLabel()),
                    'value' => $template->getCode(),
                    'image' => $template->getImage()
                );
            }

            $categories[] = array(
                'label' => $helper->__($category),
                'items' => $types
            );
        }

        return $categories;
    }
}
