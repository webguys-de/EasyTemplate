<?php

namespace Webguys\Easytemplate\Model\Observer\Page;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

use Webguys\Easytemplate\Model\Config as Config;

/**
 * Catalog inventory module observer
 */
class ViewModeObserver implements ObserverInterface
{

    /**
     * @var Config
     */
    protected $easytemplateConfig;

    /**
     * @param Config $easytemplate
     */
    public function __construct(Config $easytemplateConfig)
    {
        $this->easytemplateConfig = $easytemplateConfig;
    }

    /**
     * Detects whether product status should be shown
     *
     * @param EventObserver $observer
     * @return void
     */
    public function execute(EventObserver $observer)
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $observer->getEvent()->getForm();

        $fieldset = $form->getElement('base_fieldset');

        $fieldset->addField(
            'view_mode',
            'select',
            [
                'label' => __('View Mode'),
                'title' => __('View Mode'),
                'name' => 'view_mode',
                'required' => true,
                'options' => $this->easytemplateConfig->getViewModes(),
                'disabled' => false,
                'note' => __('Use the easytemplate engine or default behavior'),
            ]
        );
    }
}
