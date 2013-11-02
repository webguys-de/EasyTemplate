<?php

class Webguys_Easytemplate_Model_Config_Source_Template_Type
{
    const TEMPLATE_TYPES_PATH = 'easytemplate';

    public function toOptionArray()
    {
        $categories = array(
            array('value' => '', 'label' => Mage::helper('adminhtml')->__('-- Please select --'))
        );

        $helper = Mage::helper('easytemplate');

        foreach (Mage::getConfig()->getNode(self::TEMPLATE_TYPES_PATH)->children() as $category) {
            $types = array();
            $templatesPath = self::TEMPLATE_TYPES_PATH . '/' . $category->getName() . '/templates';

            foreach (Mage::getConfig()->getNode($templatesPath)->children() as $template) {
                $labelPath = self::TEMPLATE_TYPES_PATH . '/' . $category->getName() . '/templates/' . $template->getName() . '/label';
                $types[] = array(
                    'label' => $helper->__((string) Mage::getConfig()->getNode($labelPath)),
                    'value' => $template->getName()
                );
            }

            $labelPath = self::TEMPLATE_TYPES_PATH . '/' . $category->getName() . '/label';

            $categories[] = array(
                'label' => $helper->__((string) Mage::getConfig()->getNode($labelPath)),
                'value' => $types
            );
        }

        return $categories;
    }
}
