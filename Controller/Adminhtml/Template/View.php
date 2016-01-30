<?php

namespace Webguys\Easytemplate\Controller\Adminhtml\Template;

use Magento\Backend\App\Action;

class View extends \Magento\Backend\App\Action
{
    protected $config;

    protected $resultJson;

    protected $resultPageFactory;

    /**
     * @param Action\Context $context
     * @param \Webguys\Easytemplate\Model\Template $template
     */
    public function __construct(
        Action\Context $context,
        \Webguys\Easytemplate\Model\Config $config,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Controller\Result\Json $jsonFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJson = $jsonFactory;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return true;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $block = $resultPage->getLayout()->getBlock('easytemplate_template_edit');

        die( $block->toHtml() ); // TODO

        $this->resultJson->setData(array(
            'html' => $block->toHtml()
        ));

        return $this->resultJson;
    }
}
