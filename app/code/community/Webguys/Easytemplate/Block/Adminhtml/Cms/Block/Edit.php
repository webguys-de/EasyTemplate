<?php

/**
 * Class Webguys_Easytemplate_Block_Adminhtml_Cms_Block_Edit
 *
 */
class Webguys_Easytemplate_Block_Adminhtml_Cms_Block_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Initialize cms block edit block
     *
     * @return void
     */
    public function __construct()
    {
        $this->_objectId = 'block_id';
        $this->_controller = 'cms_block';
        $this->_blockGroup = null; // Workaround to avoid automatic block creation by parent

        parent::__construct();

        if ($this->_isAllowedAction('save')) {
            $this->_updateButton('save', 'label', Mage::helper('cms')->__('Save Block'));
            $this->_addButton(
                'saveandcontinue',
                array(
                    'label' => Mage::helper('adminhtml')->__('Save and Continue Edit'),
                    'onclick' => 'saveAndContinueEdit(\'' . $this->_getSaveAndContinueUrl() . '\')',
                    'class' => 'save',
                ),
                -100
            );
        } else {
            $this->_removeButton('save');
        }

        $this->_updateButton('delete', 'label', Mage::helper('cms')->__('Delete Block'));
    }

    /**
     * Retrieve text for header element depending on loaded block
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('cms_block')->getId()) {
            return Mage::helper('cms')->__("Edit Block '%s'", $this->escapeHtml(Mage::registry('cms_block')->getTitle()));
        } else {
            return Mage::helper('cms')->__('New Block');
        }
    }

    /**
     * Check permission for passed action
     *
     * @param string $action
     * @return bool
     */
    protected function _isAllowedAction($action)
    {
        return Mage::getSingleton('admin/session')->isAllowed('cms/block/' . $action);
    }

    /**
     * Getter of url for "Save and Continue" button
     * tab_id will be replaced by desired by JS later
     *
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl(
            '*/*/save',
            array(
                '_current' => true,
                'back' => 'edit',
                'active_tab' => '{{tab_id}}'
            )
        );
    }

    /**
     * Prepare layout
     *
     * @return Mage_Core_Block_Abstract
     */
    protected function _prepareLayout()
    {
        $tabsBlock = $this->getLayout()->getBlock('easytemplate_cms_block_edit_tabs');
        if ($tabsBlock) {
            $tabsBlockJsObject = $tabsBlock->getJsObjectName();
            $tabsBlockPrefix = $tabsBlock->getId() . '_';
        } else {
            $tabsBlockJsObject = 'block_tabsJsTabs';
            $tabsBlockPrefix = 'block_tabs_';
        }

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('block_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'block_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'block_content');
                }
            }

            function saveAndContinueEdit(urlTemplate) {
                var tabsIdValue = " . $tabsBlockJsObject . ".activeTab.id;
                var tabsBlockPrefix = '" . $tabsBlockPrefix . "';
                if (tabsIdValue.startsWith(tabsBlockPrefix)) {
                    tabsIdValue = tabsIdValue.substr(tabsBlockPrefix.length)
                }
                var template = new Template(urlTemplate, /(^|.|\\r|\\n)({{(\w+)}})/);
                var url = template.evaluate({tab_id:tabsIdValue});
                editForm.submit(url);
            }
        ";

        $this->setChild('form', $this->getLayout()->createBlock('easytemplate/adminhtml_cms_block_edit_form'));

        return parent::_prepareLayout();
    }
}
