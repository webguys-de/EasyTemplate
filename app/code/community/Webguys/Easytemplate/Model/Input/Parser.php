<?php

class Webguys_Easytemplate_Model_Input_Parser
{

    protected $_templates = null;

    public function getXmlConfig()
    {
        $cachedXml = Mage::app()->loadCache('easytemplate_config');
        if ($cachedXml) {
            $xmlConfig = new Varien_Simplexml_Config($cachedXml);
        } else {
            $config = new Varien_Simplexml_Config();
            $config->loadString('<?xml version="1.0"?><config><easytemplate></easytemplate></config>');
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
        if (is_null($this->_templates)) {
            $result = array();
            $path = 'easytemplate';
            $config = $this->getXmlConfig();

            foreach ($config->getNode($path)->children() as $category) {
                $templatesPath = $path . '/' . $category->getName() . '/templates';
                foreach ($config->getNode($templatesPath)->children() as $template) {

                    /** @var $parser Webguys_Easytemplate_Model_Input_Parser_Template */
                    $parser = Mage::getModel('easytemplate/input_parser_template');
                    $parser->setConfig( $template );
                    $parser->setCategory( $category->getName() );
                    $parser->setTemplateName( $template->getName() );

                    $result[] = $parser;
                }

            }
            $this->_templates = $result;
        }

        return $this->_templates;
    }

    public function getTemplate($category, $name)
    {
        $templates = $this->getTemplates();

        /** @var $template Webguys_Easytemplate_Model_Input_Parser_Template */
        foreach ($templates as $template) {

            if ($template->getCategory() == $category && $template->getTemplateName() == $name)
            {
                return $template;
            }

        }

        return false;
    }

}