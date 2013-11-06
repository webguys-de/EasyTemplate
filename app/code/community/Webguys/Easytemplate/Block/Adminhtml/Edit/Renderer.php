<?php

/**
 * Class Webguys_Easytemplate_Block_Adminhtml_Edit_Renderer
 *
 * @method getCode
 */
class Webguys_Easytemplate_Block_Adminhtml_Edit_Renderer
    extends Mage_Adminhtml_Block_Widget
{
    protected $_name = 'abstract';

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('easytemplate/edit/renderer.phtml');
    }

    protected function _prepareLayout()
    {
        $code = $this->getCode();

        /** @var $configModel Webguys_Easytemplate_Model_Input_Parser */
        $configModel = Mage::getSingleton('easytemplate/input_parser');

        if ($model = $configModel->getTemplate( $code ) ) {

            foreach ($model->getFields() as $field) {
                $inputRenderer = $field->getInputRenderer();

                $fieldAlias = $this->getBlockAliasFor($field);
                $this->setChild($fieldAlias, $inputRenderer);
            }

        }

        return parent::_prepareLayout();
    }

    protected function getBlockAliasFor($field)
    {
        return sprintf('%s_%s', $this->getCode(), $field->getCode());
    }

    protected function getRendererHtml()
    {
        // Join to avoid javascript errors for new lines
        return join('', explode("\n", $this->getChildHtml()));
    }
}
