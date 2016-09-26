<?php

/**
 * Class Webguys_Easytemplate_Block_Input_Renderer_Editor
 *
 */
class Webguys_Easytemplate_Block_Input_Renderer_Editor extends Webguys_Easytemplate_Block_Input_Renderer_Abstract
{
    /**
     * @var Varien_Data_Form_Element_Editor
     */
    protected $_editor;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('easytemplate/input/renderer/editor.phtml');
    }

    public function getDefaultBackendModel()
    {
        return Mage::getModel('easytemplate/template_data_text');
    }

    public function getEditor()
    {
        if (is_null($this->_editor)) {
            $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig(
                array(
                    'tab_id' => 'templates'
                )
            );

            $editor = new Varien_Data_Form_Element_Editor(
                array(
                    'name' => 'template[{{id}}][fields][' . $this->getCode() . ']',
                    'required' => $this->getRequired(),
                    'disabled' => false,
                    'config' => $wysiwygConfig
                )
            );

            $editor->setId($this->getCode());
            $editor->setValue($this->getValue());
            $editor->setForm($this);

            $this->_editor = $editor;
        }

        return $this->_editor;
    }

    public function getEditorHtml()
    {
        return str_replace('tinyMceWysiwygSetup', 'easytinyMceWysiwygSetup', $this->getEditor()->getElementHtml());
    }

    public function getHtmlIdPrefix()
    {
        return 'template_field_{{id}}_';
    }
}