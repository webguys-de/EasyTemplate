<?php

class Webguys_Easytemplate_Helper_Chooser extends Mage_Core_Helper_Abstract
{
    public function getInitChooserArray($id)
    {
        return array(
            'button_close' => Mage::helper('core/translate')->__('Close'),
            'title' => Mage::helper('core/translate')->__('Please Select'),

            'product_chooser_url' => Mage::getUrl('adminhtml/catalog_product_widget/chooser/', array('uniq_id' => 'chooser_' . $id)),
            'category_chooser_url' => Mage::getUrl('adminhtml/catalog_category_widget/chooser/', array('uniq_id' => 'chooser_' . $id)),
            'cms_chooser_url' => Mage::getUrl('adminhtml/cms_page_widget/chooser/', array('uniq_id' => 'chooser_' . $id)),
        );
    }

    /*
    public function getFilebrowserSetupObject( $targetElementId )
    {
        $contentHelper = new Mage_Adminhtml_Block_Cms_Wysiwyg_Images_Content();

        $setupObject = new Varien_Object();

        $setupObject->setData(array(
            'newFolderPrompt'                 => Mage::helper('cms')->__('New Folder Name:'),
            'deleteFolderConfirmationMessage' => Mage::helper('cms')->__('Are you sure you want to delete current folder?'),
            'deleteFileConfirmationMessage'   => Mage::helper('cms')->__('Are you sure you want to delete the selected file?'),
            'targetElementId' => $targetElementId,
            'contentsUrl'     => $contentHelper->getContentsUrl(),
            'onInsertUrl'     => Mage::getUrl('adminhtml/easytemplate_chooser_image/onInsert'),
            'newFolderUrl'    => $contentHelper->getNewfolderUrl(),
            'deleteFolderUrl' => $contentHelper->getDeletefolderUrl(),
            'deleteFilesUrl'  => $contentHelper->getDeleteFilesUrl(),
            'headerText'      => $contentHelper->getHeaderText()
        ));

        return Mage::helper('core')->jsonEncode($setupObject);
    }
    */

    public function getMediaOpenDialogUrl($id)
    {
        return Mage::getUrl('adminhtml/easytemplate_chooser_image/index', array('target_element_id' => $id));
    }
}
