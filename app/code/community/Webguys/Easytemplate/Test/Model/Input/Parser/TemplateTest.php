<?php

class Webguys_Easytemplate_Test_Model_Input_Parser_TemplateTest
    extends Webguys_Easytemplate_Test_Model_Input_ParserAbstract
{
    public function testParsingOfFirstTemplate()
    {
        /** @var $template Webguys_Easytemplate_Model_Input_Parser_Template */
        $template = current($this->_parser->getTemplates());

        $this->assertEquals('Überschrift + Text', $template->getLabel());
        $this->assertEquals('Hallo Welt', $template->getComment());

        $fields = $template->getFields();
        $this->assertEquals(3, count($template->getFields()));
    }
}