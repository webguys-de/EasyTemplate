<?php

class Webguys_Easytemplate_Test_Model_Input_ParserTest extends Webguys_Easytemplate_Test_Model_Input_ParserAbstract
{
    public function testConfigHasTemplates()
    {
        $this->assertEquals(2, count($this->_parser->getTemplates()));
    }
}