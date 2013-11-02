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

            }

        }

        /*
        $this->setChild('option_price_type',
            $this->getLayout()->createBlock('adminhtml/html_select')
                ->setData(array(
                    'id' => 'product_option_{{option_id}}_price_type',
                    'class' => 'select product-option-price-type'
                ))
        );
        */

        // TODO: Create dynamic interface

        return parent::_prepareLayout();
    }
}
