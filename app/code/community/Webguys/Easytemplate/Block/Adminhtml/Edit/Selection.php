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

           $helper = Mage::helper('easytemplate');

           /** @var $configModel Webguys_Easytemplate_Model_Input_Parser */
           $configModel = Mage::getSingleton('easytemplate/input_parser');
           $config = $configModel->getXmlConfig();

           foreach ($config->getNode(self::TEMPLATE_TYPES_PATH)->children() as $category) {
               $types = array();
               $templatesPath = self::TEMPLATE_TYPES_PATH . '/' . $category->getName() . '/templates';

               foreach ($config->getNode($templatesPath)->children() as $template) {
                   $labelPath = self::TEMPLATE_TYPES_PATH . '/' . $category->getName() . '/templates/' . $template->getName() . '/label';
                   $types[] = array(
                       'label' => $helper->__((string) $config->getNode($labelPath)),
                       'value' => $category->getName().'_'.$template->getName(),
                       'image' => (string)$template->image
                   );
               }

               $labelPath = self::TEMPLATE_TYPES_PATH . '/' . $category->getName() . '/label';

               $categories[] = array(
                   'label' => $helper->__((string) $config->getNode($labelPath)),
                   'items' => $types
               );
           }

           return $categories;
       }
}
