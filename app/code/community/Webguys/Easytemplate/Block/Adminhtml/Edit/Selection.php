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
    const NO_IMAGE_PATH = 'images/easytemplate/no-image.png';

    public function getCategoryLabel($_category)
    {
        $path = 'easytemplate';
        $config = Mage::getModel('easytemplate/input_parser')->getXmlConfig();

        foreach ($config->getNode($path)->children() as $category) {
            $categ = $category->asArray();
            if (isset($categ['enabled']) && $categ['enabled']) {
                if ($category->getName() == $_category) {
                    return $categ['label'];
                }
            }
        }
        return $_category;
    }

    public function getTemplateImage($image)
    {
        if ($image == '') {
            return self::NO_IMAGE_PATH;
        }
        if (file_exists(Mage::getBaseDir('skin') . '/adminhtml/default/default/' . $image)) {
            return $image;
        }
        return self::NO_IMAGE_PATH;
    }

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
                    'image' => $this->getTemplateImage($template->getImage()),
                    'hidden' => $template->isHidden(),
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
