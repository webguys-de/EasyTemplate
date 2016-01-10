<?php
namespace Webguys\Easytemplate\Controller\Adminhtml\Template;

use Magento\Backend\App\Action;

class Edit extends \Magento\Backend\App\Action
{
    protected $template;

    protected $registry;

    protected $resultJson;

    protected $resultPageFactory;

    /**
     * @param Action\Context $context
     * @param \Webguys\Easytemplate\Model\Template $template
     */
    public function __construct(
        Action\Context $context,
        \Webguys\Easytemplate\Model\Template $template,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Controller\Result\Json $jsonFactory
    )
    {
        parent::__construct($context);
        $this->template = $template->load($this->getRequest()->getParam('id'));
        $this->registry = $registry;
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
        $this->registry->register('easytemplate_template', $this->template);
        $resultPage = $this->resultPageFactory->create();
        $block = $resultPage->getLayout()->getBlock('easytemplate_template_edit');

        $this->resultJson->setData(array(
            'html' => $block->toHtml()
        ));

        return $this->resultJson;
    }
}
