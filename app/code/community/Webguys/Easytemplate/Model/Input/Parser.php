<?php

class Webguys_Easytemplate_Model_Input_Parser
{

    public function getXmlConfig()
    {
        $cachedXml = Mage::app()->loadCache('easytemplate_config');
        if ($cachedXml) {
            $xmlConfig = new Varien_Simplexml_Config($cachedXml);
        } else {
            $config = new Varien_Simplexml_Config();
            $config->loadString('<?xml version="1.0"?><easytemplate></easytemplate>');
            Mage::getConfig()->loadModulesConfiguration('easytemplate.xml', $config);
            $xmlConfig = $config;
            if (Mage::app()->useCache('config')) {
                Mage::app()->saveCache($config->getXmlString(), 'easytemplate_config',
                    array(Mage_Core_Model_Config::CACHE_TAG));
            }
        }
        return $xmlConfig;
    }

    public function getTemplates()
    {
        $templates = $this->getXmlConfig()->getNode();
        $result = array();

        foreach( $templates->children() AS $data )
        {
            /** @var $field_parser Webguys_Easytemplate_Model_Input_Parser_Template */
            $parser = Mage::getModel('easytemplate/input_parser_template');
            $parser->setConfig( $data );

            $result[] = $parser;
        }


        return $result;
    }



}