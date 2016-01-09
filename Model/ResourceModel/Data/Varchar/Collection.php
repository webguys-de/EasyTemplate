<?php

namespace Webguys\Easytemplate\Model\ResourceModel\Data\Varchar;

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
        $this->_init('Webguys\Easytemplate\Model\Data\Varchar', 'Webguys\Easytemplate\Model\ResourceModel\Data\Varchar');
    }

}
