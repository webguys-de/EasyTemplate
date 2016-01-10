<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Webguys\Easytemplate\Controller\Adminhtml\Template;

use Magento\Backend\App\Action;

class Save extends \Magento\Backend\App\Action
{


    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return true;
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        die('das auch!');
    }
}
