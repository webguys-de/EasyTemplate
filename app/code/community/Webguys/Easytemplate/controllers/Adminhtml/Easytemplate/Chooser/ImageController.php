<?php

require 'app/code/core/Mage/Adminhtml/controllers/Cms/Wysiwyg/ImagesController.php';

class Webguys_Easytemplate_Adminhtml_Easytemplate_Chooser_ImageController extends Mage_Adminhtml_Cms_Wysiwyg_ImagesController
{
    public function indexAction()
    {
        $storeId = (int)$this->getRequest()->getParam('store');

        try {
            Mage::helper('cms/wysiwyg_images')->getCurrentPath();
        } catch (Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        }

        $this->_initAction()
            ->loadLayout('overlay_popup');

        $block = $this->getLayout()->getBlock('wysiwyg_images.js');
        if ($block) {
            $block->setStoreId($storeId);
            $block->setOnInsertUrl('/'); // TODO
        }
        $this->renderLayout();
    }

    public function onInsertAction()
    {

        $helper = Mage::helper('cms/wysiwyg_images');
        $storeId = $this->getRequest()->getParam('store');

        $filename = $this->getRequest()->getParam('filename');
        $filename = $helper->idDecode($filename);

        $path = $this->getRequest()->getParam('node');
        if ($path != 'root') {
            $filename = $helper->idDecode($path) . '/' . $filename;
        }


        $asIs = $this->getRequest()->getParam('as_is');

        Mage::helper('catalog')->setStoreId($storeId);
        $helper->setStoreId($storeId);

        $image = $helper->getImageHtmlDeclaration($filename, $asIs);
        $this->getResponse()->setBody($filename);
    }
}