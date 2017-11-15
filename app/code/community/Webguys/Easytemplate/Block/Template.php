<?php

/**
 * Class Webguys_Easytemplate_Block_Template
 *
 * @method getTemplateModel
 * @method setTemplateModel
 * @method getTemplateCode
 * @method setTemplateCode
 * @method getGroup
 * @method setGroup
 */
class Webguys_Easytemplate_Block_Template extends Mage_Core_Block_Template
{
    protected $renderer = null;

    protected function getRenderer()
    {
        if (!$this->renderer) {
            $renderer = Mage::app()->getLayout()->createBlock('easytemplate/renderer');
            $renderer->setGroup($this->getGroup());
            $renderer->setChildsBasedOnGroup($this->getGroup(), $this->getTemplateModel()->getId());
            $this->renderer = $renderer;
        }
        return $this->renderer;
    }

    /**
     * @return array
     */
    public function getChildTemplates()
    {
        return $this->getRenderer()->getChild();
    }

    public function getChildHtml($name = '', $useCache = true, $sorted = false)
    {
        return $this->getRenderer()->toHtml();
    }

    public function getCacheLifetime()
    {
        if (!$this->hasData('cache_lifetime')) {
            return 3600;
        }
        return $this->getData('cache_lifetime');
    }

    protected function _loadCache()
    {
        return false; // Only Renderer is Caching
    }

}
