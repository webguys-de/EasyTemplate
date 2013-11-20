<?php

class Webguys_Easytemplate_Adminhtml_Easytemplate_Renderer_LinkController extends Mage_Adminhtml_Controller_Action
{


    public function indexAction()
    {

        $html =  '

            <script>
            //<![CDATA[
            (function() {
            var instantiateChooser = function() {
            window.template_field_14_link = new WysiwygWidget.chooser(
            "template_field_14_link",
            "http://localhost.magento/test.webguys.de/htdocs/index.php/admin/catalog_product_widget/chooser/uniq_id/template_field_14_link/",
            {"buttons":{"open":"Artikel ausw\u00e4hlen\u2026","close":"Schlie\u00dfen"}}
            );
            if ($("template_field_14_link")) {
//            $("template_field_14_link").advaiceContainer = "template_field_14_link-container";
            }

            template_field_14_link.choose();

            }
            if (document.loaded) { //allow load over ajax
            instantiateChooser();
            } else {
            document.observe("dom:loaded", instantiateChooser);
            }
            })();
            //]]>

            </script>


        ';

        $this->getResponse()->setBody($html);

    }

    public function tmpindexAction()
    {

        $uniqId = $this->getRequest()->getParam('uniq_id');
        $massAction = $this->getRequest()->getParam('use_massaction', false);
        $productTypeId = $this->getRequest()->getParam('product_type_id', null);

        $productsGrid = $this->getLayout()->createBlock('adminhtml/catalog_product_widget_chooser', '', array(
            'id'                => $uniqId,
            'use_massaction' => $massAction,
            'product_type_id' => $productTypeId,
            'category_id'       => $this->getRequest()->getParam('category_id')
        ));

        $html = $productsGrid->toHtml();

        if (!$this->getRequest()->getParam('products_grid')) {
            $categoriesTree = $this->getLayout()->createBlock('adminhtml/catalog_category_widget_chooser', '', array(
                'id'                  => $uniqId.'Tree',
                'node_click_listener' => $productsGrid->getCategoryClickListenerJs(),
                'with_empty_node'     => true
            ));

            $html = $this->getLayout()->createBlock('adminhtml/catalog_product_widget_chooser_container')
                ->setTreeHtml($categoriesTree->toHtml())
                ->setGridHtml($html)
                ->toHtml();
        }



        $this->getResponse()->setBody($html);

    }


}