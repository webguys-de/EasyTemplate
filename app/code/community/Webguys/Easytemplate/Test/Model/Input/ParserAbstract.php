<?php

class Webguys_Easytemplate_Test_Model_Input_ParserAbstract extends EcomDev_PHPUnit_Test_Case
{
    /** @var Webguys_Easytemplate_Model_Input_Parser */
    protected $_parser = null;

    public function getTestXmlData()
    {
        $config = new Varien_Simplexml_Config();
        $config->loadFile(dirname(__FILE__) . DS . 'Parser' . DS . 'core.xml');

        return $config;
    }

    public function setUp()
    {
        $this->_parser = $this->getModelMock('easytemplate/Input_Parser', array('getXmlConfig'));
        $this->_parser->expects($this->any())
            ->method('getXmlConfig')
            ->will($this->returnValue($this->getTestXmlData()));
    }
}