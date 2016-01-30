<?php

namespace Webguys\Easytemplate\Block\Adminhtml;

class Template extends \Magento\Backend\Block\Template
{
    protected $config;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Webguys\Easytemplate\Model\Config $config,
        array $data = []
    )
    {
        $this->config = $config;
        parent::__construct($context, $data);
    }

    /**
     * @return \Webguys\Easytemplate\Model\Config\Reader\Data\Template
     */
    public function getTemplateConfig()
    {
        return $this->config->findTemplate( $this->getRequest()->getParam('id') );
    }

}