<?php

/**
 * Class Webguys_Easytemplate_Block_Adminhtml_Edit_Template
 *
 */
abstract class Webguys_Easytemplate_Block_Adminhtml_Edit_Template
    extends Mage_Adminhtml_Block_Widget
{
    protected $_templateBlocks = array();

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('easytemplate/edit/template.phtml');
    }

    public function getTemplateWrapperHtml()
    {
        return $this->getLayout()->createBlock('core/template')->setTemplate('easytemplate/edit/box.phtml')->toHtml();
    }

    /**
     * Retrieve html templates for different types of product custom options
     *
     * @return string
     */
    public function getEmptyTemplates()
    {
        $templates = array();

        /** @var $configModel Webguys_Easytemplate_Model_Input_Parser */
        $configModel = Mage::getSingleton('easytemplate/input_parser');

        foreach ($configModel->getTemplates() as $template) {

            /** @var $box Webguys_Easytemplate_Block_Adminhtml_Edit_Box */
            $box = $this->getLayout()->createBlock('easytemplate/adminhtml_edit_box');
            $box->setTemplateModel($template);

            $templates[$template->getCode()] = $box->toHtml();
        }

        return $templates;
    }

    public function getExistingTemplatesHtml()
    {
        $group = $this->getGroup();
        $html = '';

        foreach ($group->getTemplateCollection() as $template) {
            /** @var $box Webguys_Easytemplate_Block_Adminhtml_Edit_Box */
            $box = $this->getLayout()->createBlock('easytemplate/adminhtml_edit_box');
            $box->setTemplateModel($template);

            $html .= $box->toHtml();
        }

        return $html;
    }

    /**
     * @return Webguys_Easytemplate_Model_Group
     */
    abstract public function getGroup();

    abstract public function getType();

    abstract public function getObjectOfType();

    public function isInTemplateMode()
    {
        if ($page = $this->getObjectOfType()) {
            return $page->getViewMode() == Webguys_Easytemplate_Model_Config_Source_Cms_Page_Viewmode::VIEWMODE_EASYTPL;
        }
        return false;
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return Mage::helper('easytemplate')->__('EasyTemplate');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('easytemplate')->__('EasyTemplate');
    }

    /**
     * Returns status flag about this tab can be showen or not
     *
     * @return true
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Returns status flag about this tab hidden or not
     *
     * @return false
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $action
     * @return bool
     */
    protected function _isAllowedAction($action)
    {
        return Mage::getSingleton('admin/session')->isAllowed('cms/' . $this->getType() . '/' . $action);
    }
}