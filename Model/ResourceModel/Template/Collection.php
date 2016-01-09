<?php

namespace Webguys\Easytemplate\Model\ResourceModel\Template;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Webguys\Easytemplate\Model\Template', 'Webguys\Easytemplate\Model\ResourceModel\Template');
    }

}
