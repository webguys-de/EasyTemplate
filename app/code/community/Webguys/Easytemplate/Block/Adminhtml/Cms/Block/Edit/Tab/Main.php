<?php

/**
 * Class Webguys_Easytemplate_Block_Adminhtml_Cms_Block_Edit_Tab_Main
 *
 */
class Webguys_Easytemplate_Block_Adminhtml_Cms_Block_Edit_Tab_Main
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    protected function _prepareForm()
    {
        /* @var $model Mage_Cms_Model_Block */
        $model = Mage::registry('cms_block');

        /*
         * Checking if user have permissions to save information
         */
        if ($this->_isAllowedAction('save')) {
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }

        $form = new Varien_Data_Form();

        $form->setHtmlIdPrefix('block_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            array('legend' => Mage::helper('cms')->__('Block Information'))
        );

        if ($model->getBlockId()) {
            $fieldset->addField(
                'block_id',
                'hidden',
                array(
                    'name' => 'block_id',
                )
            );
        }

        $fieldset->addField(
            'title',
            'text',
            array(
                'name' => 'title',
                'label' => Mage::helper('cms')->__('Block Title'),
                'title' => Mage::helper('cms')->__('Block Title'),
                'required' => true,
            )
        );

        $fieldset->addField(
            'identifier',
            'text',
            array(
                'name' => 'identifier',
                'label' => Mage::helper('cms')->__('Identifier'),
                'title' => Mage::helper('cms')->__('Identifier'),
                'required' => true,
                'class' => 'validate-xml-identifier',
            )
        );

        /**
         * Check is single store mode
         */
        if (!Mage::app()->isSingleStoreMode()) {
            $field = $fieldset->addField(
                'store_id',
                'multiselect',
                array(
                    'name' => 'stores[]',
                    'label' => Mage::helper('cms')->__('Store View'),
                    'title' => Mage::helper('cms')->__('Store View'),
                    'required' => true,
                    'values' => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
                )
            );

            $renderer = $this->getLayout()->createBlock('adminhtml/store_switcher_form_renderer_fieldset_element');
            $field->setRenderer($renderer);
        } else {
            $fieldset->addField(
                'store_id',
                'hidden',
                array(
                    'name' => 'stores[]',
                    'value' => Mage::app()->getStore(true)->getId()
                )
            );
            $model->setStoreId(Mage::app()->getStore(true)->getId());
        }

        $fieldset->addField(
            'is_active',
            'select',
            array(
                'label' => Mage::helper('cms')->__('Status'),
                'title' => Mage::helper('cms')->__('Status'),
                'name' => 'is_active',
                'required' => true,
                'options' => array(
                    '1' => Mage::helper('cms')->__('Enabled'),
                    '0' => Mage::helper('cms')->__('Disabled'),
                ),
            )
        );

        if (!$model->getId()) {
            $model->setData('is_active', '1');
        }

        Mage::dispatchEvent(
            'easytemplate_adminhtml_cms_block_edit_tab_main_prepare_form',
            array(
                'form' => $form
            )
        );

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return Mage::helper('cms')->__('Block Information');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('cms')->__('Block Information');
    }

    /**
     * Returns status flag about this tab can be shown or not
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
     * @return true
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
        return Mage::getSingleton('admin/session')->isAllowed('cms/block/' . $action);
    }
}