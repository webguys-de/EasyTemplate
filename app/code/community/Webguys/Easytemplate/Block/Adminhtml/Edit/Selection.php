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

    /**
     * searches category label out of Easytemplate XML definition
     * 
     * @param string $_category - internal code name of category
     * @return string - translated category name
     */
    public function getCategoryLabel($_category)
    {
        $path = 'easytemplate';
        $config = Mage::getModel('easytemplate/input_parser')->getXmlConfig();

        foreach ($config->getNode($path)->children() as $category) {
            $categ = $category->asArray();
            if (isset($categ['enabled']) && $categ['enabled']) {
                if ($category->getName() == $_category) {
                    if (in_array('label', explode(',', $categ['@']['translate']))) {
                        return $this->__($categ['label']);
                    }
                    return $categ['label'];
                }
            }
        }
        return $_category;
    }

    /**
     * get correct image for a template
     *
     * @param string $image - relative path to image file
     * @return string - relative path to image file to use (placeholder = fallback)
     */
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