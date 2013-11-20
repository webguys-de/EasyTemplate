<?php

/**
 * Class Webguys_Easytemplate_Model_Input_Parser
 *
 */
class Webguys_Easytemplate_Model_Input_Parser extends Mage_Core_Model_Abstract
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

    public function getCategories()
    {
        $result = array();

        foreach ($this->getTemplates() as $template) {
            $result[] = $template->getCategory();
        }

        $result = array_unique($result);
        sort($result);

        return $result;
    }

    /**
     * @param $category Category name
     *
     * @return Webguys_Easytemplate_Model_Input_Parser_Template[]
     */
    public function getTemplatesOfCategory($category)
    {
        $result = array();

        foreach ($this->getTemplates() as $template) {
            if ($template->getCategory() == $category) {
                $result[] = $template;
            }
        }

        return $result;
    }

    /**
     * Returns an array of all templates which are defined in easytemplate.xml files
     *
     * @return Webguys_Easytemplate_Model_Input_Parser_Template[]
     */
    public function getTemplates()
    {
        if (is_null($this->_templates)) {
            $result = array();
            $path = 'easytemplate';
            $config = $this->getXmlConfig();

            foreach ($config->getNode($path)->children() as $category) {
                $templatesPath = $path . '/' . $category->getName() . '/templates';
                foreach ($config->getNode($templatesPath)->children() as $template) {

                    /** @var $templateParser Webguys_Easytemplate_Model_Input_Parser_Template */
                    $templateParser = Mage::getModel('easytemplate/input_parser_template');
                    $templateParser->setConfig( $template );
                    $templateParser->setCategory( $category->getName() );

                    if ($templateParser->isEnabled()) {
                        $result[] = $templateParser;
                    }
                }

            }
            $this->_templates = $result;
        }

        return $this->_templates;
    }

    public function getTemplate( $code )
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