<?php

class Webguys_Easytemplate_Block_Adminhtml_Cms_Page_Edit_Tab_Templates_Template extends Mage_Adminhtml_Block_Widget
{
    protected $_page;

    protected $_pageInstance;

    protected $_values;

    protected $_itemCount = 1;

    protected $_templateBlocks = array();

    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('easytemplate/edit/template.phtml');
    }

    public function getTemplateWrapperHtml()
    {
        return $this->getLayout()->createBlock('core/template')->setTemplate('easytemplate/edit/wrapper.phtml')->toHtml();
    }

    protected function _prepareLayout()
    {
        $this->setChild('delete_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                    'label' => Mage::helper('easytemplate')->__('Delete Template'),
                    'class' => 'delete delete-page-template '
                ))
        );

        /** @var $configModel Webguys_Easytemplate_Model_Input_Parser */
        $configModel = Mage::getSingleton('easytemplate/input_parser');

        foreach ($configModel->getTemplates() as $template) {

            $name = $template->getCode();

            $this->setChild($name,
                $this->getLayout()->createBlock(
                    'easytemplate/adminhtml_edit_renderer',
                    'easytemplate_template_' . $name,
                    array(
                        'code' => $template->getCode()
                    )
                )
            );

            $this->_templateBlocks[] = $name;
        }

        return parent::_prepareLayout();
    }


    public function getDeleteButtonHtml()
    {
        return $this->getChildHtml('delete_button');
    }

    /**
     * Retrieve html templates for different types of product custom options
     *
     * @return string
     */
    public function getTemplatesHtml()
    {
        $templates = '';

        foreach ($this->_templateBlocks as $templateBlock) {
            $templates .= $this->getChildHtml($templateBlock)."\n";
        }

        return $templates;
    }

}
