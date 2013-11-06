<?php

class Webguys_Easytemplate_Block_Frontend_Abstract extends Mage_Core_Block_Template
{
    public function setChildsBasedOnGroup($group)
    {
        /** @var $configModel Webguys_Easytemplate_Model_Input_Parser */
        $configModel = Mage::getSingleton('easytemplate/input_parser');

        foreach ($group->getTemplateCollection() as $template) {
            if ($model = $configModel->getTemplate( $template->getCode() )) {
                $childBlock = $this->getLayout()->createBlock($model->getType());
                $childBlock->setTemplate($model->getTemplate());

                //$childBlock->setData();

                $this->setChild('block_'.$template->getCode(), $childBlock);
            }
        }
    }

    protected function _toHtml()
    {
        return $this->getChildHtml();
    }
}