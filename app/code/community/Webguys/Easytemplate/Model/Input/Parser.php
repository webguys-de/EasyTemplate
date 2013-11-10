<?php

/**
 * Class Webguys_Easytemplate_Model_Input_Parser
 *
 */
class Webguys_Easytemplate_Model_Input_Parser extends Mage_Core_Model_Abstract
{

    protected $_templates = null;

    protected function getEasytemplateSchema()
    {
        return Mage::getModuleDir('etc', 'Webguys_Easytemplate'). DS . 'easytemplate.xsd';
    }

    protected function validateConfig(Varien_Simplexml_Config $config)
    {
        $xml = $config->getXmlString();
        $doc = new DOMDocument();
        $doc->loadXML($xml);

        return $doc->schemaValidate($this->getEasytemplateSchema());
    }

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

            // Validate config with xsd
            if (!$this->validateConfig($xmlConfig)) {
                throw new Exception('easytemplate config not valid');
            }

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

                    $result[] = $parser;
                }

            }
            $this->_templates = $result;
        }

        return $this->_templates;
    }

    public function getTemplate( $code)
    {
        $templates = $this->getTemplates();

        /** @var $template Webguys_Easytemplate_Model_Input_Parser_Template */
        foreach ($templates as $template) {

            if ($template->getCode() == $code)
            {
                return $template;
            }

        }

        return false;
    }

}