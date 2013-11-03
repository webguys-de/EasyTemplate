<?php

class Webguys_Easytemplate_Block_Adminhtml_Edit_Abstract
    extends Mage_Adminhtml_Block_Widget
{
    protected $_name = 'abstract';

    protected function _prepareLayout()
    {
        $categoryName = $this->getCategoryName();
        $templateName = $this->getTemplateName();

        /** @var $configModel Webguys_Easytemplate_Model_Input_Parser */
        $configModel = Mage::getSingleton('easytemplate/input_parser');

        if ($model = $configModel->getTemplate($categoryName, $templateName)) {

            foreach ($model->getFields() as $field) {
                $backendModel = $field->getBackendModel();
                $inputRenderer = $field->getInputRenderer();

                $this->setChild('option_price_type', $inputRenderer);
            }

        }

        return parent::_prepareLayout();
    }


}
