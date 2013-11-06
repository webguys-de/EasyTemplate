<?php

/**
 * Class Webguys_Easytemplate_Block_Adminhtml_Edit_Renderer
 *
 * @method getCode
 */
class Webguys_Easytemplate_Block_Adminhtml_Edit_Box
    extends Mage_Adminhtml_Block_Widget
{

    protected $_template_model;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('easytemplate/edit/box.phtml');
    }

    public function _toHtml() {

        /** @var $input Webguys_Easytemplate_Block_Adminhtml_Edit_Renderer */
        $input = $this->getLayout()->createBlock('easytemplate/adminhtml_edit_renderer');
        $input->setTemplateModel( $this->getTemplateModel() );
        $this->setChild('input', $input);

        $html = parent::_toHtml();

        if ( $this->getTemplateModel() && $this->getTemplateModel()->getId() ) {

            foreach( $this->getTemplateModel()->getData() AS $replace => $to )
            {
                $html = str_replace('{{'.$replace.'}}', $to, $html);
            }

        }

        return $html;
    }

    /**
     * @return Webguys_Easytemplate_Model_Template
     */
    public function getTemplateModel()
    {
        return $this->_template_model;
    }

    public function setTemplateModel( Webguys_Easytemplate_Model_Template $model )
    {
        $this->_template_model = $model;
        return $this;
    }

}
