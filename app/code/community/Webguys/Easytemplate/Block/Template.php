<?php

class Webguys_Easytemplate_Block_Template extends Mage_Core_Block_Template
{
    public function getTemplateContent($identifier)
    {
        return $this->getData($identifier);
    }

    /**
     * Returns a list of all template identifiers
     */
    public function getTemplateIdentifierList()
    {
        // TODO: Useful for debug
    }
}