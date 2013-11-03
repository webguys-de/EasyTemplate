<?php

/**
 * Class Webguys_Easytemplate_Block_Adminhtml_Edit_Renderer
 *
 * @method getCategory
 * @method getCode
 */
class Webguys_Easytemplate_Block_Adminhtml_Edit_Renderer
    extends Mage_Adminhtml_Block_Widget
{
    protected $_name = 'abstract';

    protected $_childs = array();

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('easytemplate/edit/renderer.phtml');
    }

    protected function _prepareLayout()
    {
        $category = $this->getCategory();
        $code = $this->getCode();

        /** @var $configModel Webguys_Easytemplate_Model_Input_Parser */
        $configModel = Mage::getSingleton('easytemplate/input_parser');

        if ($model = $configModel->getTemplate($category, $code)) {

            foreach ($model->getFields() as $field) {
                $backendModel = $field->getBackendModel();
                $inputRenderer = $field->getInputRenderer();

                $fieldAlias = $this->getBlockAliasFor($field);
                $this->setChild($fieldAlias, $inputRenderer);
                $this->_childs[] = $fieldAlias;
            }

        }

        return parent::_prepareLayout();
    }

    protected function getBlockAliasFor($field)
    {
        return sprintf('%s_%s_%s', $this->getCategoryName(), $this->getTemplateName(), $field->getCode());
    }

    protected function getRendererHtml()
    {
        $res = '';

        foreach ($this->_childs as $child) {
            $res .= $this->getChildHtml($child);
        }

        return $res;
    }
}
