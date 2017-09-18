<?php

class Webguys_Easytemplate_Test_Model_Input_Parser_FieldTest extends Webguys_Easytemplate_Test_Model_Input_ParserAbstract
{
    public function testGetAliasname()
    {
        $field = new Webguys_Easytemplate_Model_Input_Parser_Field();

        $this->assertEquals('easytemplate/template_data_varchar', $field->getBackendModelAlias('easytemplate/template_data_varchar'));
        $this->assertEquals('easytemplate/template_data_varchar', $field->getBackendModelAlias('varchar'));

        $this->assertEquals('easytemplate/input_renderer_text', $field->getInputRenderAlias('easytemplate/input_renderer_text'));
        $this->assertEquals('easytemplate/input_renderer_text', $field->getInputRenderAlias('text'));
    }

    public function testParsingOfFirstTemplateFirstField()
    {
        /** @var $template Webguys_Easytemplate_Model_Input_Parser_Template */
        $template = current($this->_parser->getTemplates());

        /** @var $field Webguys_Easytemplate_Model_Input_Parser_Field */
        $field = current($template->getFields());

        $this->assertEquals('h1', $field->getCode());
        $this->assertEquals('Überschrift', $field->getLabel());
        $this->assertEquals('1', $field->getSortOrder());
        $this->assertEquals('Hallo EasyTemplate', $field->getDefaultValue());
        $this->assertEquals('Testkommentar', $field->getComment());
        $this->assertEquals('1', $field->getRequired());

        $this->assertInstanceOf('Webguys_Easytemplate_Model_Template_Data_Varchar', $field->getBackendModel()); // easytemplate/template_data_varchar
        $this->assertInstanceOf('Webguys_Easytemplate_Block_Input_Renderer_Text', $field->getInputRenderer()); // easytemplate/input_renderer_text
    }
}
