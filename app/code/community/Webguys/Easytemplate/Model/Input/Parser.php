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
                Mage::app()->saveCache(
                    $config->getXmlString(),
                    'easytemplate_config',
                    array(
                        Mage_Core_Model_Config::CACHE_TAG
                    )
                );

                if (Mage::getStoreConfig(
                    'easytemplate/configuration/automatically_clean_database',
                    Mage::app()->getStore()->getId()
                )
                ) {
                    // Clean the database just if caching is active to avoid performance issues
                    $this->cleanDatabase();
                }
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
     * Orders templates by sort_order attribute
     *
     * @param $a Webguys_Easytemplate_Model_Input_Parser_Template
     * @param $b Webguys_Easytemplate_Model_Input_Parser_Template
     */
    private function orderTemplates($a, $b)
    {
        if ($a->getSortOrder() == $b->getSortOrder()) {
            return 0;
        }
        return ($a->getSortOrder() < $b->getSortOrder()) ? -1 : 1;
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
                $categ = $category->asArray();
                if (isset($categ['enabled']) && $categ['enabled']) {
                    foreach ($config->getNode($templatesPath)->children() as $template) {
                        /** @var $templateParser Webguys_Easytemplate_Model_Input_Parser_Template */
                        $templateParser = Mage::getModel('easytemplate/input_parser_template');
                        $templateParser->setConfig($template);
                        $templateParser->setCategory($category->getName());

                        if ($templateParser->isEnabled()) {
                            $result[] = $templateParser;
                        }
                    }
                }
            }

            // Sort fields by sort_order
            usort($result, array($this, 'orderTemplates'));

            $this->_templates = $result;
        }

        return $this->_templates;
    }

    public function getTemplate($code)
    {
        $templates = $this->getTemplates();

        /** @var $template Webguys_Easytemplate_Model_Input_Parser_Template */
        foreach ($templates as $template) {
            if ($template->getCode() == $code) {
                return $template;
            }
        }

        return false;
    }

    /**
     * Clean database of all templates
     */
    public function cleanDatabase()
    {
        foreach ($this->getTemplates() as $template) {
            $template->cleanDatabase();
        }
    }
}