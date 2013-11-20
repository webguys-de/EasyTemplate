<?php

class Webguys_Easytemplate_Helper_Chooser extends Mage_Core_Helper_Abstract
{

    public function getInitChooserArray( $id )
    {
        return array(
            'button_close' => Mage::helper('core/translate')->__('Close'),
            'title' => Mage::helper('core/translate')->__('Please Select'),

            'product_chooser_url' => Mage::getUrl('adminhtml/catalog_product_widget/chooser/', array( 'uniq_id' => 'chooser_' . $id ) )
        );
    }

}