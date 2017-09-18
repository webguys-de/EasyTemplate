<?php

class Webguys_Easytemplate_Block_Input_Renderer_Reference extends Webguys_Easytemplate_Block_Input_Renderer_Abstract
{
    public function __construct(array $args = [])
    {
        parent::__construct($args);
        $this->setTemplate('easytemplate/input/renderer/reference.phtml');
    }

    public function getDefaultBackendModel()
    {
        return Mage::getModel('easytemplate/template_data_varchar');
    }

    public function getBoxesHtml()
    {
        $html = '';
        if ($model = $this->getTemplateModel()) {
            $collection = $model->getCollection()->addFieldToFilter('parent_id', $model->getId());
            $collection->getSelect()->order('position');

            foreach ($collection as $subModel) {
                $subModel->load($subModel->getId());

                /** @var Webguys_Easytemplate_Block_Adminhtml_Edit_Box $boxBlock */
                $boxBlock = $this->getLayout()->createBlock('easytemplate/adminhtml_edit_box');
                $boxBlock->setTemplateModel($subModel);

                $html .= $boxBlock->toHtml();
            }
        }

        return $html;
    }

    public function getReference()
    {
        return $this->getParentParserField()->getConfigAttribute('reference');
    }

    public function getReferenceLabel()
    {
        return $this->getParentParserField()->getConfigAttribute('reference_button_label');
    }

    public function getReferenceDefaultName()
    {
        $configModel = Mage::getSingleton('easytemplate/input_parser');
        if (!$configModel->getTemplate($this->getReference())) {
            Mage::getSingleton('core/session')->addError(
                $this->__('Template with reference name "%s" not found.', $this->getReference())
            );
            $ex = new Webguys_Easytemplate_Exception_RedirectException();
            $ex->prepareRedirect('adminhtml/cms_page');
            throw $ex;
        }
        return $configModel->getTemplate($this->getReference())->getLabel();
    }
}
