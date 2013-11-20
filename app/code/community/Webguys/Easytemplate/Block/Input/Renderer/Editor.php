<?php

/**
 * Class Webguys_Easytemplate_Block_Input_Renderer_Editor
 *
 */
class Webguys_Easytemplate_Block_Input_Renderer_Editor extends Webguys_Easytemplate_Block_Input_Renderer_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('easytemplate/input/renderer/editor.phtml');
    }

    public function getEditor()
    {
        $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig();

        $editor = new Varien_Data_Form_Element_Editor(array(
            'name'      => 'template[{{id}}][fields]['.$this->getCode().']',
            'required'  => $this->getRequired(),
            'disabled'  => false,
            'config'    => $wysiwygConfig
        ));

        $editor->setId($this->getCode());
        $editor->setValue($this->getValue());
        $editor->setForm($this);

        return $editor;
    }

    public function getHtmlIdPrefix()
    {
        return 'template_field_{{id}}_';
    }
}