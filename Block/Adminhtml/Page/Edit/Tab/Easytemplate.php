<?php

namespace Webguys\Easytemplate\Block\Adminhtml\Page\Edit\Tab;

class Easytemplate extends \Magento\Backend\Block\Template implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Webguys\Easytemplate\Model\ResourceModel\Template\Collection
     */
    protected $templateCollection;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        array $data = [],
        \Webguys\Easytemplate\Model\ResourceModel\Template\Collection $templateCollection
    )
    {
        $this->templateCollection = $templateCollection;
        parent::__construct($context, $data);
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('EasyTemplate');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('EasyTemplate');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    /**
     * @return \Webguys\Easytemplate\Model\ResourceModel\Template\Collection|\Webguys\Easytemplate\Model\Template[]
     * @throws \Exception
     */
    public function getTemplates()
    {
        return $this->templateCollection; // TODO: Filtering!
    }

}
